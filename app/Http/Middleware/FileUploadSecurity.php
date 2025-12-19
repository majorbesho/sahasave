<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FileUploadSecurity
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasFile('file') || $request->hasFile('image')) {
            $this->validateFiles($request);
        }

        return $next($request);
    }

    protected function validateFiles(Request $request)
    {
        $files = array_merge(
            $request->file('file', []),
            $request->file('image', []),
            $request->file('attachment', []),
            $request->file('document', [])
        );

        if (!is_array($files)) {
            $files = [$files];
        }

        foreach ($files as $file) {
            if ($file && $file->isValid()) {
                $this->validateFile($file);
            }
        }
    }

    protected function validateFile($file)
    {
        // 1. MIME type validation
        $allowedMimes = [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'text/plain',
            'text/csv'
        ];

        $realMime = $file->getMimeType();
        if (!in_array($realMime, $allowedMimes)) {
            abort(422, 'File type not allowed: ' . $realMime);
        }

        // 2. File extension validation
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt', 'csv'];
        $extension = strtolower($file->getClientOriginalExtension());

        if (!in_array($extension, $allowedExtensions)) {
            abort(422, 'File extension not allowed: ' . $extension);
        }

        // 3. Size validation
        if ($file->getSize() > 10 * 1024 * 1024) { // 10MB
            abort(422, 'File size exceeds limit');
        }
    }
}
