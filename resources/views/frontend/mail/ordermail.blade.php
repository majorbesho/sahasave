<!doctype html>
<html lang="en">

<head>
    <title>order Confirmation</title>


    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="beshog32@gmail.com">

    <!-- Stylesheets
        ============================================= -->

    <link rel="canonical" href="https://SahaSave.com .com/" />


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>

<body>



    <style>
        table,
        td,
        div,
        h1,
        p {
            font-family: Arial, sans-serif;
        }


        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
    </head>
    {{--  --}}







    <table role="presentation"
        style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation"
                    style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                    <tr>
                        <td
                            align="center"style="padding:40px 0 30px 0;background:#70bbd9;
                        background-image: -moz-linear-gradient(7deg, rgb(101 44 96) 0%, rgb(29 23 96) 50%, rgb(46 135 180) 100%);
                        background-image: -webkit-linear-gradient(7deg, rgb(101 44 96) 0%, rgb(29 23 96) 50%, rgb(46 135 180) 100%);
                        background-image: -ms-linear-gradient(7deg, rgb(101 44 96) 0%, rgb(29 23 96) 50%, rgb(46 135 180) 100%);line-height: 77px;box-shadow: 0 5px 15px 0 rgba(0, 0, 0, 0.25);">
                            <img src="https://SahaSave.com/frontend/4/assets/image/logo.png" alt=""
                                width="300" style="height:auto;display:block;" />
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:36px 30px 42px 30px;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643;">
                                        <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">
                                            Order Confirmation From SahaSave.com </h1> <br>
                                        Dear {{ $details['user_name'] }},

                                        <p
                                            style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                            Thank you for your purchase of the {{ $details['total_amount'] }} AED
                                            Voucher No. {{ $details['order_number'] }} .

                                            Please log in to your dashboard to view your voucher.


                                        </p>
                                        <p
                                            style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                            <a href="https://SahaSave.com .com/"
                                                style="color:#ee4c50;text-decoration:underline;">https://SahaSave.com
                                                .com/</a>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0;">
                                        <table role="presentation"
                                            style="width:100%;border-collapse:collapse;border:0;border-spacing:0; display:none">
                                            <tr>
                                                <td style="width:260px;padding:0;vertical-align:top;color:#153643;">
                                                    <p
                                                        style="margin:0 0 25px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                                        <img src="https://assets.codepen.io/210284/left.gif"
                                                            alt="" width="260"
                                                            style="height:auto;display:block;" />
                                                    </p>
                                                    <p
                                                        style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                                        tempus adipiscing felis, sit amet blandit ipsum volutpat sed.
                                                        Morbi porttitor, eget accumsan dictum, est nisi libero ultricies
                                                        ipsum, in posuere mauris neque at erat.</p>
                                                    <p
                                                        style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                                        <a href="http://www.example.com"
                                                            style="color:#ee4c50;text-decoration:underline;">Blandit
                                                            ipsum volutpat sed</a>
                                                    </p>
                                                </td>
                                                <td style="width:20px;padding:0;font-size:0;line-height:0;">&nbsp;</td>
                                                <td style="width:260px;padding:0;vertical-align:top;color:#153643;">
                                                    <p
                                                        style="margin:0 0 25px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                                        <img src="https://assets.codepen.io/210284/right.gif"
                                                            alt="" width="260"
                                                            style="height:auto;display:block;" />
                                                    </p>
                                                    <p
                                                        style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                                        Morbi porttitor, eget est accumsan dictum, nisi libero ultricies
                                                        ipsum, in posuere mauris neque at erat. Lorem ipsum dolor sit
                                                        amet, consectetur adipiscing elit. In tempus adipiscing felis,
                                                        sit amet blandit ipsum volutpat sed.</p>
                                                    <p
                                                        style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                                        <a href="http://www.example.com"
                                                            style="color:#ee4c50;text-decoration:underline;">In tempus
                                                            felis blandit</a>
                                                    </p>
                                                </td>
                                            </tr>




                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    @if (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() > 0)

                        @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                            <tr id="customers">

                                <td
                                    style="background:#70bbd9;
                                background-image: -moz-linear-gradient(7deg, rgb(101 44 96) 0%, rgb(29 23 96) 50%, rgb(46 135 180) 100%);
                                background-image: -webkit-linear-gradient(7deg, rgb(101 44 96) 0%, rgb(29 23 96) 50%, rgb(46 135 180) 100%);
                                background-image: -ms-linear-gradient(7deg, rgb(101 44 96) 0%, rgb(29 23 96) 50%, rgb(46 135 180) 100%);line-height: 77px;box-shadow: 0 5px 15px 0 rgba(0, 0, 0, 0.25);">

                                    @php
                                        $photos = explode(',', $item->model->photo);
                                    @endphp

                                    <img src="{{ $photos[0] }}" alt="" srcset=""
                                        style="width: 99px;padding-left: 7%;" />
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>AED {{ $item->price }}</td>

                            </tr>
                        @endforeach
                    @endif

                    <tr>
                        <td style="padding:30px;background:#ee4c50;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                                <tr>
                                    <td style="padding:0;width:50%;" align="left">
                                        <p
                                            style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                                            &reg; https://SahaSave.com .com/ 2023<br /><a
                                                href="https://SahaSave.com .com/"
                                                style="color:#ffffff;text-decoration:underline;"></a>
                                        </p>
                                    </td>
                                    <td style="padding:0;width:50%;" align="right">
                                        <table role="presentation"
                                            style="border-collapse:collapse;border:0;border-spacing:0;">
                                            <tr>
                                                <td style="padding:0 0 0 10px;width:38px;">
                                                    <a href="https://SahaSave.com .com//" style="color:#ffffff;">


                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                            <title>instagram</title>
                                                            <path
                                                                d="M7.8,2H16.2C19.4,2 22,4.6 22,7.8V16.2A5.8,5.8 0 0,1 16.2,22H7.8C4.6,22 2,19.4 2,16.2V7.8A5.8,5.8 0 0,1 7.8,2M7.6,4A3.6,3.6 0 0,0 4,7.6V16.4C4,18.39 5.61,20 7.6,20H16.4A3.6,3.6 0 0,0 20,16.4V7.6C20,5.61 18.39,4 16.4,4H7.6M17.25,5.5A1.25,1.25 0 0,1 18.5,6.75A1.25,1.25 0 0,1 17.25,8A1.25,1.25 0 0,1 16,6.75A1.25,1.25 0 0,1 17.25,5.5M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z" />
                                                        </svg>


                                                </td>
                                                <td style="padding:0 0 0 10px;width:38px;">
                                                    <a href="https://www.facebook.com/" style="color:#ffffff;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                            <title>facebook</title>
                                                            <path
                                                                d="M12 2.04C6.5 2.04 2 6.53 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.85C10.44 7.34 11.93 5.96 14.22 5.96C15.31 5.96 16.45 6.15 16.45 6.15V8.62H15.19C13.95 8.62 13.56 9.39 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96A10 10 0 0 0 22 12.06C22 6.53 17.5 2.04 12 2.04Z" />
                                                        </svg>

                                                    </a>
                                                </td>
                                                <td style="padding:0 0 0 10px;width:38px;">
                                                    <a href="https://www.youtube.com//" style="color:#ffffff;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                            <title>youtube</title>
                                                            <path
                                                                d="M10,15L15.19,12L10,9V15M21.56,7.17C21.69,7.64 21.78,8.27 21.84,9.07C21.91,9.87 21.94,10.56 21.94,11.16L22,12C22,14.19 21.84,15.8 21.56,16.83C21.31,17.73 20.73,18.31 19.83,18.56C19.36,18.69 18.5,18.78 17.18,18.84C15.88,18.91 14.69,18.94 13.59,18.94L12,19C7.81,19 5.2,18.84 4.17,18.56C3.27,18.31 2.69,17.73 2.44,16.83C2.31,16.36 2.22,15.73 2.16,14.93C2.09,14.13 2.06,13.44 2.06,12.84L2,12C2,9.81 2.16,8.2 2.44,7.17C2.69,6.27 3.27,5.69 4.17,5.44C4.64,5.31 5.5,5.22 6.82,5.16C8.12,5.09 9.31,5.06 10.41,5.06L12,5C16.19,5 18.8,5.16 19.83,5.44C20.73,5.69 21.31,6.27 21.56,7.17Z" />
                                                        </svg>
                                                    </a>
                                                </td>


                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>






</body>

</html>
