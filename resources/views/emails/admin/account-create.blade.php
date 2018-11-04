@extends('emails.template.admin.app')

@section('content')

@php

$urlLogin = sprintf('%s/%s',
    env('APP_URL_ADMIN'),
    'login'
); 

$urlReset = sprintf('%s/%s',
    env('APP_URL_ADMIN'),
    'password/reset'
); 

@endphp

<table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:#d8e2e7;" align="center" border="0">
  <tbody>
    <tr>
      <td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:1px;">
        <!--[if mso | IE]>
        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td style="vertical-align:top;width:700px;">
              <![endif]-->
              <div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
                <table role="presentation" cellpadding="0" cellspacing="0" style="background:white;" width="100%" border="0">
                  <tbody>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0px;padding:20px 20px 20px 20px;" align="left">
                        <div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:24px;line-height:22px;text-align:left;">
                            Confirmação de conta
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0px;padding:0px 20px 0px 20px;" align="left">
                        <div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;line-height:22px;text-align:left;">Olá <b>{{ $user->name }}</b></div>
                      </td>
                    </tr>
                 
                    <tr>
                      <td style="word-wrap:break-word;font-size:0px;padding:0px 0px 20px 20px;" align="left">
                        <div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;line-height:22px;text-align:left;">
                            Segue abaixo as informações de acesso:
                            <br />
                            <br />
                            <span style="font-weight:bold;">Email:</span> {{$user->email}}
                            <br/>
                            <span style="font-weight:bold;">Senha:</span> *** escolhido por Você ***
                            <!-- End of Content Text -->
                            <br/>
                            <br/>
                            Se você não sabe do que se trata. Você pode desconsiderar este e-mail, pois nada será alterado.
                            <br/>
                            <br/>
                            Para fazer o login, acesse <a href="{{ $urlLogin }}">{{ $urlLogin }}</a>
                            <br/>
                            Para recuperar a senha, acesse <a href="{{ $urlReset }}">{{ $urlReset }}</a>
                            <br/> <br/> 
                            Atenciosamente, <br/> 
                            {{ env('APP_NAME') }}

                          </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!--[if mso | IE]>
            </td>
          </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
  </tbody>
</table>
@endsection
