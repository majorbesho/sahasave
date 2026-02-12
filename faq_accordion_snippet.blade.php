                        <div class="accordion" id="faq-details">
                            @if(isset($faqs) && $faqs->count() > 0)
                                @foreach($faqs as $index => $faq)
                                    @php
                                        $isFirst = $index === 0;
                                        $collapseId = 'collapse' . ucfirst(\Illuminate\Support\Str::camel('item_' . $faq->id));
                                        $headingId = 'heading' . ucfirst(\Illuminate\Support\Str::camel('item_' . $faq->id));
                                    @endphp
                                    <!-- FAQ Item -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="{{ $headingId }}">
                                            <a href="javascript:void(0);" 
                                               class="accordion-button {{ $isFirst ? '' : 'collapsed' }}" 
                                               data-bs-toggle="collapse"
                                               data-bs-target="#{{ $collapseId }}" 
                                               aria-expanded="{{ $isFirst ? 'true' : 'false' }}" 
                                               aria-controls="{{ $collapseId }}">
                                                {{ $faq->translate(app()->getLocale())->question ?? $faq->translate('ar')->question ?? $faq->translate('en')->question }}
                                            </a>
                                        </h2>
                                        <div id="{{ $collapseId }}" 
                                             class="accordion-collapse collapse {{ $isFirst ? 'show' : '' }}"
                                             aria-labelledby="{{ $headingId }}" 
                                             data-bs-parent="#faq-details">
                                            <div class="accordion-body">
                                                <div class="accordion-content">
                                                    {!! $faq->translate(app()->getLocale())->answer ?? $faq->translate('ar')->answer ?? $faq->translate('en')->answer !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /FAQ Item -->
                                @endforeach
                            @else
                                <!-- Default FAQ Item when no F AQs in database -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <a href="javascript:void(0);" class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            How do I book an appointment with a doctor?
                                        </a>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#faq-details">
                                        <div class="accordion-body">
                                            <div class="accordion-content">
                                                <p>
                                                    Yes, simply visit our website and log in or create an account.
                                                    Search for a doctor based on specialization, location, or
                                                    availability & confirm your booking.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /FAQ Item -->
                            @endif
                        </div>
