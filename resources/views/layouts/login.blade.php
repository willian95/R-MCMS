<!DOCTYPE html>
<html lang="en">

<head>
    <title>R&M CMS</title>
    <meta charset="UTF-8">
	<link rel="shortcut icon" type="image/x-icon" href="{{ url('assets/img/favicon.png')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


</head>

<body>

    <style>
    /*---------------------------------------------*/
    .login_admin input {
        outline: none;
        border: none;
    }

    .login_admin textarea {
        outline: none;
        border: none;
    }

    .login_admin textarea:focus,
    .login_admin input:focus {
        border-color: transparent !important;
    }

    .login_admin input:focus::-webkit-input-placeholder {
        color: transparent;
    }

    .login_admin input:focus:-moz-placeholder {
        color: transparent;
    }

    .login_admin input:focus::-moz-placeholder {
        color: transparent;
    }

    .login_admin input:focus:-ms-input-placeholder {
        color: transparent;
    }

    .login_admin textarea:focus::-webkit-input-placeholder {
        color: transparent;
    }

    .login_admin textarea:focus:-moz-placeholder {
        color: transparent;
    }

    .login_admin textarea:focus::-moz-placeholder {
        color: transparent;
    }

    .login_admin textarea:focus:-ms-input-placeholder {
        color: transparent;
    }

    .login_admin input::-webkit-input-placeholder {
        color: #999999;
    }

    .login_admin input:-moz-placeholder {
        color: #999999;
    }

    .login_admin input::-moz-placeholder {
        color: #999999;
    }

    .login_admin input:-ms-input-placeholder {
        color: #999999;
    }

    .login_admin textarea::-webkit-input-placeholder {
        color: #999999;
    }

    .login_admin textarea:-moz-placeholder {
        color: #999999;
    }

    .login_admin textarea::-moz-placeholder {
        color: #999999;
    }

    .login_admin textarea:-ms-input-placeholder {
        color: #999999;
    }


    .login_admin label {
        display: block;
        margin: 0;
    }

    /*---------------------------------------------*/
    .login_admin button {
        outline: none !important;
        border: none;
        background: #e50019;
        width: 114px;

        font-family: inherit !important;
    }

    .login_admin button:hover {
        cursor: pointer;
    }

    .login_admin iframe {
        border: none !important;
    }


    .txt1 {
        font-family: Montserrat-Regular;
        font-size: 13px;
        line-height: 1.4;
        color: #555555;
    }

    .txt2 {
        font-family: Montserrat-Regular;
        font-size: 13px;
        line-height: 1.4;
        color: #999999;
    }


    .container-login100 {
        width: 100%;
        min-height: 100vh;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        background: #f2f2f2;
    }


    .wrap-login100 {
        width: 100%;
        background: #fff;
        overflow: hidden;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        flex-direction: row-reverse;

    }


    .login100-more {
        width: calc(100% - 560px);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }



    .login100-more p {
        color: #fff;
        font-size: 30px;
        font-weight: 700;
    }

    .login100-more::before {
        content: "";
        display: block;
        position: absolute;
        z-index: -1;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: rgb(0 0 0 / 11%);

    }




    .login100-form {
        width: 560px;
        min-height: 100vh;
        display: block;
        background-color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .login100-form-title {
        width: 100%;
        display: block;
        font-family: Poppins-Regular;
        font-size: 30px;
        color: #333333;
        line-height: 1.2;
        text-align: center;
    }





    .wrap-input100 {
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        flex-wrap: wrap;
        align-items: flex-end;
        width: 80%;
        height: 80px;
        position: relative;
        border: none;
        border-radius: 0;
        margin-bottom: 10px;
        border-bottom: 1px solid #e6e6e6;
    }

    .label-input100 {

        font-size: 17px;
        color: #999999;
        line-height: 1.2;
        display: block;
        position: absolute;
        pointer-events: none;
        width: 100%;
        padding-left: 6px;
        left: 0;
        top: 5px;
        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        -moz-transition: all 0.4s;
        transition: all 0.4s;
    }

    .input100 {
        display: block;
        width: 100%;
        background: #fff;

        font-size: 18px;
        color: #555555;
        line-height: 1.2;
        padding: 0 26px;
    }

    input.input100 {
        height: 100%;
        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        -moz-transition: all 0.4s;
        transition: all 0.4s;
        background: #ffff;
    }

    /*---------------------------------------------*/

    .focus-input100 {
        position: absolute;
        display: block;
        width: calc(100% + 2px);
        height: calc(100% + 2px);
        top: -1px;
        left: -1px;
        pointer-events: none;

        border: none;
        border-radius: 0;
        margin-bottom: 10px;
        border-bottom: 1px solid #076d9d;
        border-radius: 0;
        visibility: hidden;
        opacity: 0;

        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        -moz-transition: all 0.4s;
        transition: all 0.4s;

        -webkit-transform: scaleX(1.1) scaleY(1.3);
        -moz-transform: scaleX(1.1) scaleY(1.3);
        -ms-transform: scaleX(1.1) scaleY(1.3);
        -o-transform: scaleX(1.1) scaleY(1.3);
        transform: scaleX(1.1) scaleY(1.3);
    }

    .input100:focus+.focus-input100 {
        visibility: visible;
        opacity: 1;

        -webkit-transform: scale(1);
        -moz-transform: scale(1);
        -ms-transform: scale(1);
        -o-transform: scale(1);
        transform: scale(1);
    }

    .eff-focus-selection {
        visibility: visible;
        opacity: 1;

        -webkit-transform: scale(1);
        -moz-transform: scale(1);
        -ms-transform: scale(1);
        -o-transform: scale(1);
        transform: scale(1);
    }

    .input100:focus {
        height: 48px;
    }

    .input100:focus+.focus-input100+.label-input100 {
        top: 14px;
        font-size: 13px;
    }

    .has-val {
        height: 48px !important;
    }

    .has-val+.focus-input100+.label-input100 {
        top: 14px;
        font-size: 13px;
    }


    .input-checkbox100 {
        display: none;
    }

    .label-checkbox100 {

        font-size: 13px;
        color: #999999;
        line-height: 1.4;

        display: block;
        position: relative;
        padding-left: 26px;
        cursor: pointer;
    }

    .label-checkbox100::before {
        content: "\f00c";
        font-family: FontAwesome;
        font-size: 13px;
        color: transparent;

        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        width: 18px;
        height: 18px;
        border-radius: 2px;
        background: #fff;
        border: 1px solid #6675df;
        left: 0;
        top: 50%;
        -webkit-transform: translateY(-50%);
        -moz-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        -o-transform: translateY(-50%);
        transform: translateY(-50%);
    }

    .input-checkbox100:checked+.label-checkbox100::before {
        color: #6675df;
    }



    .container-login100-form-btn {
        width: 100%;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .login100-form-btn {
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0 20px;
        width: 100%;
        height: 50px;
        border-radius: 10px;
        background: #6675df;

        font-family: Montserrat-Bold;
        font-size: 12px;
        color: #fff;
        line-height: 1.2;
        text-transform: uppercase;
        letter-spacing: 1px;

        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        -moz-transition: all 0.4s;
        transition: all 0.4s;
    }

    .login100-form-btn:hover {
        background: #0a74ad;
    }



    /*------------------------------------------------------------------
[ Responsive ]*/

    @media (max-width: 992px) {
        .login100-form {
            width: 50%;
            padding-left: 30px;
            padding-right: 30px;
        }

        .login100-more {
            width: 50%;
        }
    }

    @media (max-width: 768px) {
        .login100-form {
            width: 100%;
        }

        .login100-more {
            display: none;
        }
    }

    @media (max-width: 576px) {
        .login100-form {
            padding-left: 15px;
            padding-right: 15px;
            padding-top: 70px;
        }
    }



    @media (max-width: 992px) {
        .alert-validate::before {
            visibility: visible;
            opacity: 1;
        }
    }



    /*==================================================================
[ Social ]*/
    .login100-form-social-item {
        width: 36px;
        height: 36px;
        font-size: 18px;
        color: #fff;
        border-radius: 50%;
    }

    .login100-form-social-item:hover {
        background: #333333;
        color: #fff;
    }

    .login_admin {
        overflow: hidden;
        height: 100vh;
    }

    .logo-admin {
        width: 40%;
    }
    </style>

    @yield('content')

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('/js/app.js') }}"></script>

    @stack('scripts')

</body>

</html>
