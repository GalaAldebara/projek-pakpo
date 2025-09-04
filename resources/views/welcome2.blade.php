<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --muted: #D9D9D9;
            --edf-2-f-7: #EDF2F7;
        }

        .font-poppins {
            font-family: 'Poppins', -apple-system, Roboto, Helvetica, sans-serif;
        }
    </style>
</head>
<body class="bg-white overflow-hidden">
    <div class="pl-20 lg:pl-20 md:pl-5 sm:pl-5">
        <div class="flex gap-5 lg:flex-col lg:gap-0 md:flex-col md:gap-0 sm:flex-col sm:gap-0">
            <!-- Left Column - Login Form -->
            <div class="flex flex-col w-[34%] lg:w-full md:w-full sm:w-full">
                <div class="flex min-h-[638px] pb-16 items-start gap-2.5 self-stretch justify-start lg:mt-10 md:mt-10 sm:mt-10 my-auto">
                    <div class="flex min-w-[240px] w-[404px] flex-col">
                        <!-- Title -->
                        <div class="self-start flex min-h-[53px] items-start gap-2.5 text-black justify-start font-poppins font-medium text-[32px]">
                            <div>Welcome Back</div>
                        </div>

                        <!-- Email Field -->
                        <div class="flex mt-[58px] lg:mt-10 md:mt-10 sm:mt-10 min-h-[58px] w-full flex-col font-poppins font-medium">
                            <div class="self-start flex items-start gap-2.5 text-sm text-black justify-start">
                                <div>Email address</div>
                            </div>
                            <div class="rounded-[10px] flex min-h-8 w-full max-w-[404px] items-center gap-2.5 overflow-hidden text-[10px] text-[var(--muted)] justify-start py-[9px] px-2.5 border border-[#D9D9D9]">
                                <div class="self-stretch flex items-start gap-2.5 justify-center my-auto">
                                    <input type="email"
                                           placeholder="Enter your email"
                                           class="text-[var(--muted)] bg-transparent border-none outline-none w-full font-poppins text-[10px]">
                                </div>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="flex mt-5 min-h-[58px] w-full flex-col font-poppins font-medium">
                            <div class="self-start flex items-start gap-2.5 text-sm text-black justify-start">
                                <div>Password</div>
                            </div>
                            <div class="rounded-[10px] flex min-h-8 w-full max-w-[404px] items-center gap-2.5 overflow-hidden text-[10px] text-[var(--muted)] justify-start py-[9px] px-2.5 border border-[#D9D9D9]">
                                <div class="self-stretch flex items-start gap-2.5 justify-center my-auto">
                                    <input type="password"
                                           placeholder="Enter your password"
                                           class="text-[var(--muted)] bg-transparent border-none outline-none w-full font-poppins text-[10px]">
                                </div>
                            </div>
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="self-start flex mt-5 items-stretch gap-1.5 text-black font-poppins font-medium text-[9px]">
                            <div class="rounded-[2px] self-start flex w-[9px] flex-shrink-0 h-2.5 border border-black"></div>
                            <div class="flex-1">
                                Remember me
                            </div>
                        </div>

                        <!-- Login Button -->
                        <div class="flex mt-8 pb-2.5 flex-col bg-[var(--edf-2-f-7)]">
                            <div class="w-full">
                                <div class="rounded-[10px] bg-[#3A5B22] flex min-h-8 w-full max-w-[404px] items-center gap-2.5 overflow-hidden justify-start py-[9px] px-2.5 border border-[#3A5B22] cursor-pointer hover:bg-[#2d4619] transition-colors">
                                    <div class="self-stretch flex min-h-[15px] gap-2.5 my-auto"></div>
                                </div>
                            </div>
                            <div class="text-white self-center z-10 -mt-[26px] font-poppins font-bold text-[13px]">
                                Login
                            </div>
                        </div>

                        <!-- Or Divider -->
                        <div class="bg-white self-center flex mt-[59px] lg:mt-10 md:mt-10 sm:mt-10 w-5 items-center gap-2.5 overflow-hidden text-black justify-center px-[3px] font-poppins font-medium text-[9px]">
                            <div class="self-stretch my-auto">Or</div>
                        </div>

                        <!-- Social Login Buttons -->
                        <div class="flex mt-[61px] lg:mt-10 md:mt-10 sm:mt-10 items-start gap-[23px] text-black font-poppins font-medium text-xs">
                            <!-- Google Login -->
                            <div class="flex-1 rounded-[10px] border border-[var(--muted)] flex flex-col overflow-hidden justify-center py-1 px-5">
                                <div class="flex items-center gap-2.5 justify-start">
                                    <img src="https://api.builder.io/api/v1/image/assets/ac97ccd019ee46bc88d4a0e79732854f/026f27051f8353c999a94bc8b157b2d6db141e2c?placeholderIfAbsent=true"
                                         class="aspect-square object-contain w-6 self-stretch flex-shrink-0 my-auto"
                                         alt="Google">
                                    <div class="self-stretch my-auto">Sign in with Google</div>
                                </div>
                            </div>

                            <!-- Apple Login -->
                            <div class="flex-1 rounded-[10px] border border-[var(--muted)] flex flex-col overflow-hidden justify-center py-1 px-5">
                                <div class="flex items-center gap-2.5 justify-center">
                                    <img src="https://api.builder.io/api/v1/image/assets/ac97ccd019ee46bc88d4a0e79732854f/21dca9682e7831ff6158020c17a8651d6351d021?placeholderIfAbsent=true"
                                         class="aspect-square object-contain w-6 self-stretch flex-shrink-0 my-auto"
                                         alt="Apple">
                                    <div class="self-stretch my-auto">Sign in with Apple</div>
                                </div>
                            </div>
                        </div>

                        <!-- Sign Up Link -->
                        <div class="self-center mt-[23px] min-h-[23px] w-[183px] max-w-full text-black font-poppins font-medium text-sm">
                            <div class="w-full">
                                <div>
                                    Don't have an account?
                                    <span class="text-[#0F3DDE] cursor-pointer hover:underline">Sign Up</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Image -->
            <div class="flex flex-col w-[66%] ml-5 lg:w-full lg:ml-0 md:w-full md:ml-0 sm:w-full sm:ml-0">
                <img src="https://api.builder.io/api/v1/image/assets/ac97ccd019ee46bc88d4a0e79732854f/2b6e32dabbd2de61ac5e6176604ff51d28ec2380?placeholderIfAbsent=true"
                     class="aspect-[0.75] object-contain w-full rounded-tl-[45px] flex-grow lg:max-w-full lg:mt-10 md:max-w-full md:mt-10 sm:max-w-full sm:mt-10"
                     alt="Login illustration">
            </div>
        </div>
    </div>
</body>
</html>
