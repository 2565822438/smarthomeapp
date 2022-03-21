<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>登录 ‹ 个人主页 — WordPress</title>
    <script>
        if ("sessionStorage" in window) {
            try {
                for (var key in sessionStorage) {
                    if (key.indexOf("wp-autosave-") != -1) {
                        sessionStorage.removeItem(key);
                    }
                }
            } catch (e) {}
        }
    </script>
    <meta name="robots" content="noindex, follow" />
    <link rel="dns-prefetch" href="css/null_16907fce0e894ecfa2b7b9b35a0d536c." />
    <link rel="stylesheet" id="dashicons-css" href="css/dashicons.min.css" type="text/css" media="all" />
    <link rel="stylesheet" id="buttons-css" href="css/buttons.min.css" type="text/css" media="all" />
    <link rel="stylesheet" id="forms-css" href="css/forms.min.css" type="text/css" media="all" />
    <link rel="stylesheet" id="l10n-css" href="css/l10n.min.css" type="text/css" media="all" />
    <link rel="stylesheet" id="login-css" href="css/login.min.css" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/login.css" />
    <script type="text/javascript" src="js/jquery.min.js"></script>

    <style>
        body {
            font-family: "Noto Serif SC", "Source Han Serif SC", "Source Han Serif",
                "source-han-serif-sc", "PT Serif", "SongTi SC", "MicroSoft Yahei",
                Georgia, serif !important;
        }
    </style>
    
    <link rel="icon" href="css/cropped-logo-32x32.png" sizes="32x32" />
    <link rel="icon" href="css/cropped-logo-192x192.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="css/cropped-logo-180x180.png" />
</head>

<body class="login no-js login-action-login wp-core-ui locale-zh-cn">
    <script type="text/javascript">
        document.body.className = document.body.className.replace("no-js", "js");
    </script>
    <div id="login">
        <h1><a href="https://www.yyqing.net/">个人主页</a></h1>
        <p class="message">您已注销。<br /></p>
        <form name="loginform" id="loginform" action="{{ route('login') }}" method="post">
            @csrf
            <p>
                <label for="email">{{__('Email')}}</label>
                <input type="email" name="email" id="email" aria-describedby="login_error" class="input" :value="old('email')" size="20" autocapitalize="off" />
            </p>
            <div class="user-pass-wrap">
                <label for="user_pass" :value="__('Password')">{{__('password')}}</label>
                <div class="wp-pwd">
                    <input type="password" name="password" id="password" aria-describedby="login_error" class="input password-input" value="" size="20" />
                    <button type="button" class="button button-secondary wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="显示密码">
                        <span class="dashicons dashicons-visibility" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
            <p class="forgetmenot">
                <input name="rememberme" type="checkbox" id="rememberme" value="forever" />
                <label for="rememberme">记住我</label>
            </p>
            <p class="submit">
                <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="{{ __('Log in') }}" />
               
            </p>
        </form>
        <p id="nav">
            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            |
            @if(Route::has('password.request'))
            <a href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}</a>
            @endif
        </p>
        <script type="text/javascript">
            function wp_attempt_focus() {
                setTimeout(function() {
                    try {
                        d = document.getElementById("user_login");
                        d.focus();
                        d.select();
                    } catch (er) {}
                }, 200);
            }
            wp_attempt_focus();
            if (typeof wpOnload === "function") {
                wpOnload();
            }
        </script>
        <p id="backtoblog">
            <a href="https://www.yyqing.net/">← 返回到个人主页</a>
        </p>
    </div>
    <div class="language-switcher">
        
    </div>
    <script type="text/javascript" src="js/login.js"></script>
    <script type="text/javascript">
        jQuery("body").prepend(
            '<div class="loading"><img src="https://cdn.jsdelivr.net/gh/moezx/cdn@3.1.9/img/Sakura/images/login_loading.gif" width="58" height="10"></div><div id="bg"><img /></div>'
        );
        jQuery("#bg")
            .children("img")
            .attr(
                "src",
                "https://cdn.jsdelivr.net/gh/mashirozx/Sakura@3.2.7/images/hd.png"
            )
            .load(function() {
                resizeImage("bg");
                jQuery(window).bind("resize", function() {
                    resizeImage("bg");
                });
                jQuery(".loading").fadeOut();
            });
    </script>
    <script>
        function verificationOK() {
            var x,
                y,
                z = "verification";
            var x = $("#loginform").find('input[name="verification"]').val();
            //var x=document.forms["loginform"]["verification"].value; //原生js实现
            var y = $("#registerform").find('input[name="verification"]').val();
            var z = $("#lostpasswordform").find('input[name="verification"]').val();
            if (x == "verification" || y == "verification" || z == "verification") {
                alert("Please slide the block to verificate!");
                return false;
            }
        }
        $(document).ready(function() {
            $(
                '<p><div id="verification-slider"><div id="slider"><div id="slider_bg"></div><span id="label">»</span><span id="labelTip">Slide to Verificate</span></div><input type="hidden" name="verification" value="verification" /></div><p>'
            ).insertBefore($(".submit"));
            $("form").attr("onsubmit", "return verificationOK();");
            $("h1 a").attr("style", "background-image: url(); ");
            $(".forgetmenot").replaceWith(
                '<p class="forgetmenot">Remember Me<input name="rememberme" id="rememberme" value="forever" type="checkbox"><label for="rememberme" style="float: right;margin-top: 5px;transform: scale(2);margin-right: -10px;"></label></p>'
            );
        });
    </script>
    <script type="text/javascript">
        var startTime = 0;
        var endTime = 0;
        var numTime = 0;
        $(function() {
            var slider = new SliderUnlock(
                "#slider", {
                    successLabelTip: "OK",
                },
                function() {
                    var sli_width = $("#slider_bg").width();
                    $("#verification-slider")
                        .html("")
                        .append(
                            '<input id="verification-ok" class="input" type="text" size="25" value="OK!" name="verification" disabled="true" />'
                        );

                    endTime = nowTime();
                    numTime = endTime - startTime;
                    endTime = 0;
                    startTime = 0;
                    // 获取到滑动使用的时间 滑动的宽度
                    // alert( numTime );
                    // alert( sli_width );
                }
            );
            slider.init();
        });

        /**
         * 获取时间精确到毫秒
         * @type
         */
        function nowTime() {
            var myDate = new Date();
            var H = myDate.getHours(); //获取小时
            var M = myDate.getMinutes(); //获取分钟
            var S = myDate.getSeconds(); //获取秒
            var MS = myDate.getMilliseconds(); //获取毫秒
            var milliSeconds = H * 3600 * 1000 + M * 60 * 1000 + S * 1000 + MS;
            return milliSeconds;
        }
    </script>
    <script type="text/javascript" src="js/verification.js"></script>
    <script type="text/javascript" src="js/jquery.min_882f8ecf42364c04b95b5051956d2ef1.js" id="jquery-core-js"></script>
    <script type="text/javascript" src="js/jquery-migrate.min.js" id="jquery-migrate-js"></script>
    <script type="text/javascript" id="zxcvbn-async-js-extra">
        /* <![CDATA[ */
        var _zxcvbnSettings = {
            src: "https:\/\/www.yyqing.net\/wp-includes\/js\/zxcvbn.min.js",
        };
        /* ]]> */
    </script>
    <script type="text/javascript" src="js/zxcvbn-async.min.js" id="zxcvbn-async-js"></script>
    <script type="text/javascript" src="js/regenerator-runtime.min.js" id="regenerator-runtime-js"></script>
    <script type="text/javascript" src="js/wp-polyfill.min.js" id="wp-polyfill-js"></script>
    <script type="text/javascript" src="js/hooks.min.js" id="wp-hooks-js"></script>
    <script type="text/javascript" src="js/i18n.min.js" id="wp-i18n-js"></script>
    <script type="text/javascript" id="wp-i18n-js-after">
        wp.i18n.setLocaleData({
            "text direction\u0004ltr": ["ltr"]
        });
    </script>
    <script type="text/javascript" id="password-strength-meter-js-extra">
        /* <![CDATA[ */
        var pwsL10n = {
            unknown: "\u5bc6\u7801\u5f3a\u5ea6\u672a\u77e5",
            short: "\u975e\u5e38\u5f31",
            bad: "\u5f31",
            good: "\u4e2d\u7b49",
            strong: "\u5f3a",
            mismatch: "\u4e0d\u5339\u914d",
        };
        /* ]]> */
    </script>
    <script type="text/javascript" id="password-strength-meter-js-translations">
        (function(domain, translations) {
            var localeData =
                translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2022-03-02 18:10:35+0000",
            generator: "GlotPress\/3.0.0-alpha.2",
            domain: "messages",
            locale_data: {
                messages: {
                    "": {
                        domain: "messages",
                        "plural-forms": "nplurals=1; plural=0;",
                        lang: "zh_CN",
                    },
                    "%1$s is deprecated since version %2$s! Use %3$s instead. Please consider writing more inclusive code.": [
                        "\u81ea%2$s\u7248\u5f00\u59cb\uff0c%1$s\u5df2\u7ecf\u6dd8\u6c70\uff0c\u8bf7\u6539\u7528%3$s\u3002\u8bf7\u8003\u8651\u64b0\u5199\u66f4\u5177\u517c\u5bb9\u6027\u7684\u4ee3\u7801\u3002",
                    ],
                },
            },
            comment: {
                reference: "wp-admin\/js\/password-strength-meter.js"
            },
        });
    </script>
    <script type="text/javascript" src="js/password-strength-meter.min.js" id="password-strength-meter-js"></script>
    <script type="text/javascript" src="js/underscore.min.js" id="underscore-js"></script>
    <script type="text/javascript" id="wp-util-js-extra">
        /* <![CDATA[ */
        var _wpUtilSettings = {
            ajax: {
                url: "\/wp-admin\/admin-ajax.php"
            }
        };
        /* ]]> */
    </script>
    <script type="text/javascript" src="js/wp-util.min.js" id="wp-util-js"></script>
    <script type="text/javascript" id="user-profile-js-extra">
        /* <![CDATA[ */
        var userProfileL10n = {
            user_id: "0",
            nonce: "f558bbaab0"
        };
        /* ]]> */
    </script>
    <script type="text/javascript" id="user-profile-js-translations">
        (function(domain, translations) {
            var localeData =
                translations.locale_data[domain] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData(localeData, domain);
        })("default", {
            "translation-revision-date": "2022-03-02 18:10:35+0000",
            generator: "GlotPress\/3.0.0-alpha.2",
            domain: "messages",
            locale_data: {
                messages: {
                    "": {
                        domain: "messages",
                        "plural-forms": "nplurals=1; plural=0;",
                        lang: "zh_CN",
                    },
                    "Your new password has not been saved.": [
                        "\u60a8\u7684\u65b0\u5bc6\u7801\u672a\u88ab\u4fdd\u5b58\u3002",
                    ],
                    Hide: ["\u9690\u85cf"],
                    Show: ["\u663e\u793a"],
                    "Confirm use of weak password": [
                        "\u786e\u8ba4\u4f7f\u7528\u5f31\u5bc6\u7801",
                    ],
                    "Hide password": ["\u9690\u85cf\u5bc6\u7801"],
                    "Show password": ["\u663e\u793a\u5bc6\u7801"],
                },
            },
            comment: {
                reference: "wp-admin\/js\/user-profile.js"
            },
        });
    </script>
    <script type="text/javascript" src="js/user-profile.min.js" id="user-profile-js"></script>
    <div class="clear"></div>
</body>

</html>