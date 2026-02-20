<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
    @endif
</head>

<body>
    <header
        class="sticky top-0 z-50 transition-all duration-300 bg-bg-1 dark:bg-gray-900 text-black dark:text-gray-300">
        <div class="relative mx-auto">
            <nav class="mx-auto mr-2 flex items-center justify-between px-2 py-4 md:mr-5 md:px-10 md:py-1 2xl:px-16">
                <div class="w-40 cursor-pointer px-2 md:w-44 lg:block lg:w-auto lg:px-0"><a href="/"><img
                            alt="BDDTI Logo" width="100" height="35" decoding="async" data-nimg="1"
                            src="{{ asset('assets/image/logo/logo (1).png') }}" style="color: transparent;"></a></div>
                <div class="hidden flex-grow xl:block">
                    <ul class="flex items-center justify-center xl:gap-5 2xl:gap-10">
                        <li class="group relative"><a
                                class="relative cursor-pointer px-[2px] py-1 font-inter text-[15px] tracking-wide transition-colors duration-300 ease-in-out dark:text-gray-300 font-bold text-[#1e3a8a] dark:text-white "
                                href="/">Home<span
                                    class="absolute bottom-0 left-0 h-[3px] w-0 origin-left bg-gradient-to-r from-sky-100 via-sky-300 to-sky-500 transition-all duration-500 ease-out group-hover:w-full w-full"
                                    style="background-size: 200% 100%; animation: 2s linear 0s infinite normal none running slideUnderline;"></span></a>
                        </li>
                        <li class="group relative"><a
                                class="relative cursor-pointer px-[2px] py-1 font-inter text-[15px] tracking-wide transition-colors duration-300 ease-in-out dark:text-gray-300 font-medium text-gray-800 "
                                href="/about-us">About Us<span
                                    class="absolute bottom-0 left-0 h-[3px] w-0 origin-left bg-gradient-to-r from-sky-100 via-sky-300 to-sky-500 transition-all duration-500 ease-out group-hover:w-full "
                                    style="background-size: 100% 100%; animation: auto ease 0s 1 normal none running none;"></span></a>
                        </li>
                        <li class="group relative"><a
                                class="relative cursor-pointer px-[2px] py-1 font-inter text-[15px] tracking-wide transition-colors duration-300 ease-in-out dark:text-gray-300 font-medium text-gray-800 "
                                href="/courses">Courses<span
                                    class="absolute bottom-0 left-0 h-[3px] w-0 origin-left bg-gradient-to-r from-sky-100 via-sky-300 to-sky-500 transition-all duration-500 ease-out group-hover:w-full "
                                    style="background-size: 100% 100%; animation: auto ease 0s 1 normal none running none;"></span></a>
                        </li>
                        <li class="group relative"><a
                                class="relative cursor-pointer px-[2px] py-1 font-inter text-[15px] tracking-wide transition-colors duration-300 ease-in-out dark:text-gray-300 font-medium text-gray-800 "
                                href="/contact-us">Contact Us<span
                                    class="absolute bottom-0 left-0 h-[3px] w-0 origin-left bg-gradient-to-r from-sky-100 via-sky-300 to-sky-500 transition-all duration-500 ease-out group-hover:w-full "
                                    style="background-size: 100% 100%; animation: auto ease 0s 1 normal none running none;"></span></a>
                        </li>
                    </ul>
                </div>
                <div class="flex items-center"><button aria-label="Toggle Dark Mode"
                        class="rounded p-2 text-gray-800 transition xl:mr-5"><svg stroke="currentColor"
                            fill="currentColor" stroke-width="0" viewBox="0 0 16 16"
                            class="text-xl text-blue-500 transition-all duration-300" height="1em" width="1em"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708">
                            </path>
                        </svg></button>
                    <div class="mr-16 hidden xl:block">
                        <div class="flex space-x-4"><a
                                class="inline-block rounded border border-bg-2 px-5 py-2 font-inter text-sm font-bold text-black transition-colors duration-300 hover:bg-primary-hover hover:text-white dark:text-white"
                                href="/signin">Sign In</a>
                        </div>
                        <div class="flex items-center gap-5 md:gap-10">
                            <div class="lg: ml-5 xl:hidden"><a
                                    class="rounded bg-primary px-2 py-1.5 text-sm text-white transition hover:bg-sky-600 dark:bg-sky-600 md:px-4"
                                    href="/signin">Sign In</a></div><button aria-label="Open Menu"
                                class="text-3xl text-sky-600 xl:hidden"><svg stroke="currentColor" fill="currentColor"
                                    stroke-width="0" viewBox="0 0 20 20" aria-hidden="true" height="1em"
                                    width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M2 4.75A.75.75 0 0 1 2.75 4h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 4.75Zm0 10.5a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5a.75.75 0 0 1-.75-.75ZM2 10a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 10Z"
                                        clip-rule="evenodd"></path>
                                </svg></button>
                        </div>
                    </div>
            </nav>
            <div class="relative z-10"><button id="cart-icon"
                    class="absolute right-5 top-4 flex cursor-pointer items-center justify-start rounded-full bg-white p-2 shadow-xl md:right-[50px] md:top-10 xl:-top-[44px] xl:right-[60px] xl:bg-transparent xl:p-0 xl:shadow-none 2xl:right-[85px]"><span
                        class="relative text-3xl text-orange-600"><svg stroke="currentColor" fill="currentColor"
                            stroke-width="0" viewBox="0 0 576 512" class="block lg:hidden" height="24"
                            width="24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z">
                            </path>
                        </svg><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 576 512"
                            class="hidden lg:block" height="1em" width="1em"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z">
                            </path>
                        </svg><span
                            class="font-base absolute -right-5 -top-2 h-5 w-5 rounded-full bg-orange-600 px-1 text-sm text-white">0</span></span></button>
                <div class="fixed left-5 top-8 md:left-auto md:right-60 hidden">
                    <div class="right-16 z-50 mt-10 w-full md:right-0 md:px-10">
                        <div class="m-auto grid rounded-md bg-white p-2 shadow-md dark:bg-gray-900 md:grid-cols-1">
                            <div class="relative hidden overflow-x-auto sm:rounded-lg md:block">
                                <table
                                    class="w-full text-left text-sm text-gray-500 dark:text-gray-400 rtl:text-right">
                                    <thead class="bg-[#28AAE1]/80 text-xs uppercase text-white dark:bg-gray-800">
                                        <tr>
                                            <th class="px-6 py-3">Course Name</th>
                                            <th class="px-6 py-3">Price</th>
                                            <th class="px-6 py-3 text-center">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr class="bg-[#007bc7]/10 text-black dark:bg-sky-900/50 dark:text-white">
                                            <th class="px-6 py-3">Total Cost</th>
                                            <th class="px-6 py-3 text-center">৳&nbsp;0</th>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="block w-full space-y-1 md:hidden">
                                <div
                                    class="w-[320px] rounded border border-gray-200 bg-gradient-to-r from-gray-50 to-white p-4 text-center">
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">No data found.</p>
                                </div>
                            </div>
                            <div
                                class="mt-2 flex w-full items-center justify-between rounded border bg-[#28AAE1] p-2 text-sm text-white md:hidden">
                                <p>Total Cost</p>
                                <p> ৳&nbsp;0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="relative h-auto w-full" style="
    ">
        <div class="absolute inset-0 -z-10 bg-[#0359A9] dark:bg-gray-900"><img alt="Hero background" decoding="async"
                data-nimg="fill" class="object-cover" src="{{ asset('assets/image/slider-bg.webp') }}"
                style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
            <div class="absolute inset-0 bg-[#0359A9]/70 dark:bg-gray-900/70"></div>
        </div>
        <div
            class="relative z-10 mx-auto overflow-hidden px-2 py-10 lg:py-[70px] xl:max-w-[1360px] xl:px-12 2xl:max-w-[1480px] 2xl:px-12">
            <div class="flex flex-col-reverse items-center justify-center lg:flex-row">
                <div class="relative w-full px-0 md:ml-28 lg:ml-0 lg:w-6/12 lg:px-0">
                    <div
                        class="mt-4 w-max rounded-[149px] border border-[#C8C8C8] px-3 py-2 pb-1 text-base font-semibold text-[#E0FF55] dark:border-gray-500 md:px-5 md:py-3 md:pb-2 md:text-2xl lg:mt-0 2xl:px-8 2xl:py-4 2xl:pb-2 2xl:text-3xl tiro_bangla_57cffe6f-module__vF7Mtq__className">
                        শীর্ষস্থানীয় মান, এশিয়ার শ্রেষ্ঠে</div>
                    <h1
                        class="hero_title font-siraj mt-2 px-2 pt-0 text-[26px] font-bold uppercase text-white md:px-0 md:pt-0 md:text-[50px] lg:text-[40px] xl:text-[55px] 2xl:text-[62px] anek_bangla_9e651d83-module__hqwGvq__className">
                        শ্রেষ্ঠে ড্রাইভিং ট্রেনিং <br> ইনস্টিটিউট</h1>
                    <p
                        class="mt-2 px-4 pt-1 text-lg font-medium text-white md:px-0 md:pt-0 md:text-xl 2xl:text-2xl tiro_bangla_57cffe6f-module__vF7Mtq__className">
                        -নিরাপদ সড়ক ও দক্ষ জনশক্তি তৈরিতে অঙ্গীকারবদ্ধ।</p>
                    <div class="sr-only">
                        <p>BDDTI offers comprehensive driving education with certified instructors and modern vehicles.
                            Our
                            programs include theoretical and practical training, <a href="/driving-license">license
                                assistance</a>, and road safety education. We serve students across Bangladesh with<a
                                href="/branches">branches in major cities</a>. Learn more <a href="/about-us">about
                                our
                                mission</a> to create safer roads through quality driver training and education.</p>
                        <p>Driving training at BDDTI covers essential skills such as vehicle control, traffic rules,
                            emergency procedures, and defensive driving. We provide personalized attention in small
                            classes
                            to ensure effective learning. Our curriculum is updated regularly to reflect the latest
                            driving
                            standards and technologies. Explore our <a href="/courses">driving courses</a> and <a
                                href="/why-choose-us">why choose BDDTI</a> for professional training.</p>
                        <p>Students at BDDTI receive hands-on experience with various vehicle types under expert
                            supervision. We emphasize safety protocols and practical scenarios to prepare drivers for
                            real-world conditions. Our success rate in license examinations is among the highest in the
                            industry. Read our <a href="/blog">blog for driving tips</a> and <a
                                href="/contact-us">contact
                                us</a> for enrollment.</p>
                    </div>
                    <div class="flex flex-row gap-6 px-2 py-4 md:items-center md:gap-10 md:px-0 md:py-7">
                        <div>
                            <p
                                class="tiro_bangla_57cffe6f-module__vF7Mtq__className flex items-center gap-4 text-lg text-white lg:text-xl 2xl:text-2xl">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 32 32"
                                    class="text-2xl text-white lg:text-5xl" height="1em" width="1em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M 6.59375 6 C 5.257813 6 4.023438 6.667969 3.28125 7.78125 L 0.5 11.9375 C 0.171875 12.429688 0 13 0 13.59375 L 0 20.21875 C 0 21.132813 0.613281 21.933594 1.5 22.15625 L 4.09375 22.8125 C 4.46875 24.628906 6.078125 26 8 26 C 9.851563 26 11.398438 24.71875 11.84375 23 L 21.15625 23 C 21.601563 24.71875 23.148438 26 25 26 C 26.851563 26 28.398438 24.71875 28.84375 23 L 30 23 C 31.09375 23 32 22.09375 32 21 L 32 17.34375 C 32 15.511719 30.746094 13.910156 28.96875 13.46875 L 23.5625 12.09375 L 19.65625 7.4375 C 18.894531 6.527344 17.78125 6 16.59375 6 Z M 6.59375 8 L 11 8 L 11 12 L 2.875 12 L 4.9375 8.90625 L 4.9375 8.875 C 5.308594 8.316406 5.921875 8 6.59375 8 Z M 13 8 L 16.59375 8 C 17.1875 8 17.746094 8.261719 18.125 8.71875 L 20.875 12 L 13 12 Z M 2 14 L 22.875 14 L 28.5 15.40625 C 29.394531 15.628906 30 16.421875 30 17.34375 L 30 21 L 28.84375 21 C 28.398438 19.28125 26.851563 18 25 18 C 23.148438 18 21.601563 19.28125 21.15625 21 L 11.84375 21 C 11.398438 19.28125 9.851563 18 8 18 C 6.226563 18 4.738281 19.171875 4.21875 20.78125 L 2 20.21875 Z M 8 20 C 9.117188 20 10 20.882813 10 22 C 10 23.117188 9.117188 24 8 24 C 6.882813 24 6 23.117188 6 22 C 6 20.882813 6.882813 20 8 20 Z M 25 20 C 26.117188 20 27 20.882813 27 22 C 27 23.117188 26.117188 24 25 24 C 23.882813 24 23 23.117188 23 22 C 23 20.882813 23.882813 20 25 20 Z">
                                    </path>
                                </svg> প্রাইভেট কার
                            </p>
                            <p
                                class="tiro_bangla_57cffe6f-module__vF7Mtq__className flex items-center gap-4 text-lg text-white lg:text-xl 2xl:text-2xl">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                                    class="text-2xl text-white lg:text-5xl" height="1em" width="1em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.36547 10L11.2 8H14.6915L13.5996 5H11V3H15L16.0919 6H20V9H17.1838L18.6405 13.0022C21.0608 13.0764 23 15.0617 23 17.5C23 19.9853 20.9853 22 18.5 22C16.0147 22 14 19.9853 14 17.5C14 15.6722 15.0897 14.0989 16.6549 13.3944L15.4194 10H14.4718L12.89 15.87L9.96536 16.9389C9.98822 17.1227 10 17.31 10 17.5C10 19.9853 7.98528 22 5.5 22C3.01472 22 1 19.9853 1 17.5C1 15.5407 2.25221 13.8738 4 13.2561V12H2V10H8.36547ZM5.5 20C6.88071 20 8 18.8807 8 17.5C8 16.1193 6.88071 15 5.5 15C4.11929 15 3 16.1193 3 17.5C3 18.8807 4.11929 20 5.5 20ZM18.5 20C19.8807 20 21 18.8807 21 17.5C21 16.1193 19.8807 15 18.5 15C17.1193 15 16 16.1193 16 17.5C16 18.8807 17.1193 20 18.5 20Z">
                                    </path>
                                </svg> মোটরসাইকেল
                            </p>
                        </div>
                        <div class="hidden h-[100px] w-[2px] rounded-full bg-gray-300 lg:block"></div>
                        <div>
                            <p
                                class="tiro_bangla_57cffe6f-module__vF7Mtq__className flex items-center gap-4 text-lg text-white lg:text-xl 2xl:text-2xl">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                                    class="text-2xl text-white lg:text-5xl" height="1em" width="1em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16 1C16.5523 1 17 1.44772 17 2V3H22V9H19.9813L22.7271 16.5439C22.9033 16.9948 23 17.4856 23 17.999C23 20.2082 21.2091 21.999 19 21.999C17.1365 21.999 15.5707 20.7247 15.1263 19H10.874C10.4299 20.7252 8.86384 22 7 22C5.05551 22 3.43508 20.6125 3.07474 18.7736C2.43596 18.4396 2 17.7707 2 17V7C2 6.44772 2.44772 6 3 6H10C10.5523 6 11 6.44772 11 7V12C11 12.5523 11.4477 13 12 13H14C14.5523 13 15 12.5523 15 12V3H12V1H16ZM7 16C5.89543 16 5 16.8954 5 18C5 19.1046 5.89543 20 7 20C8.10457 20 9 19.1046 9 18C9 16.8954 8.10457 16 7 16ZM19 15.999C17.8954 15.999 17 16.8944 17 17.999C17 19.1036 17.8954 19.999 19 19.999C20.1046 19.999 21 19.1036 21 17.999C21 17.7587 20.9576 17.5282 20.8799 17.3148L20.8635 17.2714C20.5725 16.5266 19.8479 15.999 19 15.999ZM17.853 9H17V12C17 13.6569 15.6569 15 14 15H12C10.3431 15 9 13.6569 9 12H4V15.3542C4.73294 14.5238 5.80531 14 7 14C8.86384 14 10.4299 15.2748 10.874 17H15.1258C15.5695 15.2743 17.1358 13.999 19 13.999C19.2368 13.999 19.4688 14.0196 19.6943 14.0591L17.853 9ZM9 8H4V10H9V8ZM20 5H17V7H20V5Z">
                                    </path>
                                </svg> স্কুটার
                            </p>
                            <p
                                class="tiro_bangla_57cffe6f-module__vF7Mtq__className flex items-center gap-4 text-lg text-white lg:text-xl 2xl:text-2xl">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                                    class="text-2xl text-white lg:text-5xl" height="1em" width="1em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path
                                        d="M15.5 5.5c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zM5 12c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 8.5c-1.9 0-3.5-1.6-3.5-3.5s1.6-3.5 3.5-3.5 3.5 1.6 3.5 3.5-1.6 3.5-3.5 3.5zm5.8-10 2.4-2.4.8.8c1.3 1.3 3 2.1 5.1 2.1V9c-1.5 0-2.7-.6-3.6-1.5l-1.9-1.9c-.5-.4-1-.6-1.6-.6s-1.1.2-1.4.6L7.8 8.4c-.4.4-.6.9-.6 1.4 0 .6.2 1.1.6 1.4L11 14v5h2v-6.2l-2.2-2.3zM19 12c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 8.5c-1.9 0-3.5-1.6-3.5-3.5s1.6-3.5 3.5-3.5 3.5 1.6 3.5 3.5-1.6 3.5-3.5 3.5z">
                                    </path>
                                </svg> বাইসাইকেল
                            </p>
                        </div>
                    </div>
                    <div class="ml-3 mt-4 flex items-center gap-4 lg:ml-0 lg:mt-5 lg:gap-6"><a
                            class="group relative z-20 overflow-hidden rounded-lg px-6 py-3 text-base font-bold text-white shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-white/50 md:px-8 md:py-3.5 md:text-lg lg:text-xl"
                            aria-label="Apply for BDDTI driving course — opens application form" href="/application"
                            style="background: linear-gradient(90deg, rgb(22, 163, 74) 0%, rgb(5, 150, 105) 10%, rgb(8, 145, 178) 20%, rgb(2, 132, 199) 30%, rgb(14, 165, 233) 40%, rgb(37, 99, 235) 50%, rgb(59, 130, 246) 60%, rgb(14, 165, 233) 70%, rgb(2, 132, 199) 80%, rgb(5, 150, 105) 90%, rgb(22, 163, 74) 100%) 0% 0% / 300% 100%; animation: 8s linear 0s infinite normal none running gradientShift;"><span
                                class="relative z-10 flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 transition-transform duration-300 group-hover:-rotate-90 md:h-6 md:w-6"
                                    viewBox="0 0 20 20" fill="currentColor ">
                                    <path fill-rule="evenodd"
                                        d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                                        clip-rule="evenodd"></path>
                                </svg>আবেদন করুন</span>
                            <div
                                class="absolute inset-0 -z-10 bg-white/20 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                            </div>
                        </a><a
                            class="group relative z-20 overflow-hidden rounded-lg border border-white/80 bg-white/10 px-4 py-3 text-sm font-semibold uppercase text-white backdrop-blur-sm transition-all duration-300 hover:scale-105 hover:border-white hover:bg-white/20 hover:shadow-lg dark:border-gray-500 dark:bg-transparent md:px-6 md:py-3.5 md:text-base lg:text-lg"
                            aria-label="Learn why to choose BDDTI — opens why choose page" href="/why-choose-us"><span
                                class="relative z-10">Why Choose Us</span>
                            <div
                                class="absolute inset-0 -z-10 bg-gradient-to-r from-sky-400/20 to-blue-400/20 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                            </div>
                        </a></div>
                </div>
                <div class="relative p-4 md:w-10/12 lg:w-5/12 2xl:w-6/12">
                    <img alt="Hero image" decoding="async" data-nimg="intrinsic" class="rounded-lg object-cover"
                        src="{{ asset('assets/image/slider-image-t-bg.png') }}"
                        style="color: transparent; width: 86%; height: auto;">
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-900" style="opacity: 1; transform: none;">
        <div class="mx-auto max-w-7xl px-4">
            <div class="container flex items-center justify-center px-4 py-10">
                <div class="grid grid-cols-2 gap-8 md:grid-cols-4 md:gap-4">

                    <!-- Total Learners -->
                    <div
                        class="flex flex-col items-center border-dashed border-primary last:border-0 dark:border-gray-500 md:justify-center md:space-y-2 md:border-r md:px-24">
                        <i class="fas fa-graduation-cap text-[50px] text-white"></i>
                        <h2 class="phudu-font text-[26px] font-normal dark:text-white">55,000+</h2>
                        <h3
                            class="whitespace-nowrap text-center text-base text-primary dark:text-sky-400 md:text-[18px]">
                            Total Learners
                        </h3>
                    </div>

                    <!-- Active Students -->
                    <div
                        class="flex flex-col items-center border-dashed border-primary last:border-0 dark:border-gray-500 md:justify-center md:space-y-2 md:border-r md:px-24">
                        <i class="fa-solid fa-bridge-circle-check text-[50px] text-white"></i>
                        <h2 class="phudu-font text-[26px] font-normal dark:text-white">1,200+</h2>
                        <h3
                            class="whitespace-nowrap text-center text-base text-primary dark:text-sky-400 md:text-[18px]">
                            Active Students
                        </h3>
                    </div>

                    <!-- Successful Drivers -->
                    <div
                        class="flex flex-col items-center border-dashed border-primary last:border-0 dark:border-gray-500 md:justify-center md:space-y-2 md:border-r md:px-24">
                        <i class="fas fa-car text-[50px] text-white"></i>
                        <h2 class="phudu-font text-[26px] font-normal dark:text-white">52,000+</h2>
                        <h3
                            class="whitespace-nowrap text-center text-base text-primary dark:text-sky-400 md:text-[18px]">
                            Licensed Drivers
                        </h3>
                    </div>

                    <!-- Branches -->
                    <div
                        class="flex flex-col items-center border-dashed border-primary last:border-0 dark:border-gray-500 md:justify-center md:space-y-2 md:px-24">
                        <i class="fas fa-building text-[50px] text-white"></i>
                        <h2 class="phudu-font text-[26px] font-normal dark:text-white">15+</h2>
                        <h3
                            class="whitespace-nowrap text-center text-base text-primary dark:text-sky-400 md:text-[18px]">
                            Training Branches
                        </h3>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="bg-bg-1 px-2 bg-[#0F1725]">
        <div class="mx-auto max-w-7xl px-4 py-12 lg:py-24">

            <div class="flex flex-col items-center gap-10 lg:flex-row">

                <!-- TEXT COLUMN -->
                <div class="flex w-full flex-col justify-center lg:w-1/2 lg:px-10">
                    <h2 class="text-sm font-semibold uppercase tracking-wider text-[#00588F] dark:text-sky-400">
                        Why Choose Our Driving Academy
                    </h2>

                    <h3 class="onest-font mt-3 text-2xl font-bold dark:text-gray-100 md:text-3xl xl:text-4xl">
                        Learn Driving Safely & Confidently
                    </h3>

                    <p class="mt-4 max-w-xl text-gray-600 dark:text-gray-300">
                        We provide professional driving training with certified instructors, modern vehicles,
                        and practical road experience to build confidence and safety.
                    </p>

                    <ul class="mt-6 space-y-4 text-gray-700 dark:text-gray-400">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check"></i>
                            <span><strong>Certified Instructors:</strong> Trained & experienced professionals.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check"></i>
                            <span><strong>Real Road Practice:</strong> Hands-on driving experience.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check"></i>
                            <span><strong>Flexible Schedule:</strong> Morning, evening & weekend classes.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check"></i>
                            <span><strong>Modern Vehicles:</strong> Manual & automatic options.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check"></i>
                            <span><strong>License Support:</strong> BRTA guidance & assistance.</span>
                        </li>
                    </ul>

                    <a href="/why-choose-us"
                        class="mt-8 inline-block w-fit rounded-md bg-primary px-6 py-3
                       text-sm font-semibold uppercase text-white transition hover:bg-primary-hover">
                        Learn More
                    </a>
                </div>

                <!-- IMAGE COLUMN -->
                <div class="relative w-full lg:w-1/2">
                    <div class="relative overflow-hidden rounded-xl shadow-xl">
                        <img src="{{ asset('assets/image/image-2.jpg') }}"
                            class="h-full w-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-7xl px-4">
            <div class="container px-2 py-10 lg:py-24">
                <div class="flex items-center justify-center">
                    <div class="flex flex-col gap-8 lg:flex-row">

                        <!-- Left Image Column -->
                        <div class="relative order-2 hidden w-full md:flex lg:order-1 lg:w-1/2 items-center"
                            style="opacity: 1; transform: none;">
                            <div class="flex gap-2">
                                <img class="rounded-xl" alt="experience background" loading="lazy" width="100%" decoding="async" data-nimg="1"
                                    src="{{ asset('assets/image/image-3.jpg') }}" style="color: transparent;">
                            </div>
                        </div>

                        <!-- Right Text Column -->
                        <div class="order-1 w-full md:px-12 lg:order-2 lg:w-1/2 lg:px-5 xl:px-20"
                            style="opacity: 1; transform: none;">
                            <h2 class="text-xl uppercase text-[#00588F] dark:text-sky-400 md:text-2xl">About Us</h2>
                            <h3 class="onest-font py-5 text-2xl font-semibold dark:text-gray-100 md:py-4 md:text-4xl">
                                Shaping
                                Safe and Confident Drivers</h3>
                            <p class="text-base text-gray-600 dark:text-gray-300">
                                At <a class="font-semibold text-[#00588F] dark:text-[#0283d3]"
                                    href="/">BDDTI</a>, we focus on
                                creating skilled drivers who navigate roads safely and confidently.
                            </p>
                            <p class="text-base text-gray-600 dark:text-gray-300">
                                Our certified instructors provide personalized lessons for beginners, experienced
                                drivers, and
                                professionals looking to enhance their driving skills.
                            </p>
                            <p class="text-base text-gray-600 dark:text-gray-300">
                                We specialize in practical driving lessons, theoretical education, and guidance through
                                the
                                licensing process.
                            </p>
                            <p class="text-base text-gray-600 dark:text-gray-300">
                                Our structured programs combine hands-on training with comprehensive classroom
                                instruction to
                                ensure you pass both theoretical and practical tests with confidence.
                            </p>

                            <a href="/why-choose-us" class="mt-8 inline-block w-fit rounded-md bg-primary px-6 py-3
                                                   text-sm font-semibold uppercase text-white transition hover:bg-primary-hover">
                                Learn More
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-5 pt-5 bg-[#0F1725]">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="mx-auto mb-8 text-center md:mb-12 md:w-[700px]">
                <h2 class="text-xl uppercase text-[#00588F] dark:text-sky-400">Our Courses</h2>
                <h3 class="onest-font py-5 text-2xl font-semibold dark:text-gray-100 md:py-4 md:text-4xl">
                    Popular Courses & Licence
                </h3>
                <p class="text-base font-light text-[#545454] dark:text-gray-300">
                    We offer a range of professional driving courses to suit beginners and experienced drivers. Our
                    structured programs ensure safe and confident driving!
                </p>
            </div>

            <!-- Courses Grid -->
            <div class="flex flex-wrap justify-center -mx-3">

                <!-- Course Card 1 -->
                <div class="w-full sm:w-6/12 lg:w-4/12 xl:w-3/12 px-3 mb-6">
                    <div
                        class="group flex flex-col justify-between rounded-md border bg-gray-50 shadow-md transition hover:shadow-2xl dark:border-gray-600 dark:bg-gray-800">

                        <div class="h-[200px] overflow-hidden rounded-t-md">
                            <img class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                                src="https://api.bddti.com/uploads/course/1742205902_WhatsApp Image 2025-03-17 at 2.21.36 PM.jpeg"
                                alt="International Driving License Standard">
                        </div>

                        <div class="p-5 flex flex-col flex-grow">
                            <div class="flex items-center justify-between pb-3">
                                <span class="text-xl font-semibold text-[#00588F] dark:text-sky-400">৳ 9,999</span>
                            </div>

                            <a href="#">
                                <h2 class="onest-font pb-3 text-lg font-semibold text-white my-3">
                                    ইন্টারন্যাশনাল ড্রাইভিং লাইসেন্স
                                    <span class="block text-sm text-gray-500">(Standard Delivery)</span>
                                </h2>
                            </a>

                            <div class="space-y-3 text-sm text-gray-600 dark:text-gray-300">
                                <p>⏳ প্রসেসিং সময়: ২৫ কর্মদিবস</p>
                                <p>💰 মোট ফি: এককালীন পরিশোধযোগ্য</p>
                                <p>📄 আন্তর্জাতিকভাবে গ্রহণযোগ্য লাইসেন্স</p>
                            </div>
                        </div>

                        {{-- <div class="flex justify-center gap-3 pb-5">
                            <button class="rounded-md bg-primary px-4 py-2 text-white hover:bg-primary-hover">
                                Add to Cart
                            </button>
                            <a href="/courses/course-details/24"
                                class="rounded-md border border-sky-400 px-4 py-2 hover:bg-primary hover:text-white">
                                Details
                            </a>
                        </div> --}}
                    </div>
                </div>

                <!-- Course Card 2 -->
                <div class="w-full sm:w-6/12 lg:w-4/12 xl:w-3/12 px-3 mb-6">
                    <div
                        class="group flex flex-col justify-between rounded-md border bg-gray-50 shadow-md transition hover:shadow-2xl dark:border-gray-600 dark:bg-gray-800">

                        <div class="h-[200px] overflow-hidden rounded-t-md">
                            <img class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                                src="https://api.bddti.com/uploads/course/1742205976_WhatsApp Image 2025-03-17 at 2.48.02 PM.jpeg"
                                alt="International Driving License Urgent">
                        </div>

                        <div class="p-5 flex flex-col flex-grow">
                            <div class="flex items-center justify-between pb-3">
                                <span class="text-xl font-semibold text-[#00588F] dark:text-sky-400">৳ 12,999</span>
                            </div>

                            <a href="#">
                                <h2 class="onest-font pb-3 text-lg font-semibold text-white my-3">
                                    ইন্টারন্যাশনাল ড্রাইভিং লাইসেন্স
                                    <span class="block text-sm text-gray-500">(Urgent Delivery)</span>
                                </h2>
                            </a>

                            <div class="space-y-3 text-sm text-gray-600 dark:text-gray-300 ">
                                <p>⚡ প্রসেসিং সময়: ১৫ কর্মদিবস</p>
                                <p>💰 দ্রুত প্রসেসিং সুবিধা</p>
                                <p>📄 বিদেশ ভ্রমণের জন্য উপযোগী</p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Course Card 3 -->
                <div class="w-full sm:w-6/12 lg:w-4/12 xl:w-3/12 px-3 mb-6">
                    <div
                        class="group flex flex-col justify-between rounded-md border bg-gray-50 shadow-md transition hover:shadow-2xl dark:border-gray-600 dark:bg-gray-800">

                        <div class="h-[200px] overflow-hidden rounded-t-md">
                            <img class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                                src="https://api.bddti.com/uploads/course/1742206013_WhatsApp Image 2025-03-17 at 3.55.41 PM.jpeg"
                                alt="BRTA Most Urgent License">
                        </div>

                        <div class="p-5 flex flex-col flex-grow">
                            <div class="flex items-center justify-between pb-3">
                                <span class="text-xl font-semibold text-[#00588F] dark:text-sky-400">৳ 15,999</span>
                            </div>

                            <a href="#">
                                <h2 class="onest-font pb-3 text-lg font-semibold text-white my-3">
                                    BRTA ইন্টারন্যাশনাল ড্রাইভিং লাইসেন্স
                                    <span class="block text-sm text-gray-500">(Most Urgent)</span>
                                </h2>
                            </a>

                            <div class="space-y-3 text-sm text-gray-600 dark:text-gray-300">
                                <p>🚀 প্রসেসিং সময়: মাত্র ৭ কর্মদিবস</p>
                                <p>🏆 সর্বোচ্চ প্রাধান্য সুবিধা</p>
                                <p>📄 দ্রুত বিদেশ যাত্রার জন্য আদর্শ</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <footer class="bg-gray-100 dark:bg-gray-800">
        <div class="mx-auto max-w-7xl px-4">
        <div
            class="flex flex-col items-center justify-between gap-4 py-5 text-center text-sm text-gray-500 dark:border-gray-700 dark:text-gray-400 lg:flex-row">
            <p>
                © 2026 <span class="font-medium text-gray-700 dark:text-gray-200">MS</span>.
                All rights reserved.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-3">
                <span>
                    Developed by
                    <a target="_blank" href="#"
                        class="font-medium text-gray-600 hover:text-primary-hover dark:text-gray-300">
                        Selim
                    </a>
                </span>

                <span class="hidden lg:inline">|</span>

                <a href="#" class="hover:text-primary-hover">
                    Terms & Conditions
                </a>

                <a href="#" class="hover:text-primary-hover">
                    Certificate Check
                </a>

                <a href="#" class="hover:text-primary-hover">
                    Password Reset
                </a>
            </div>
        </div>
        </div>
    </footer>
</body>

</html>
