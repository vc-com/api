@extends('emails.template.admin.app')

@section('content')

@php

$urlToken = sprintf('%s/password/forgot/%s',
    env('APP_URL_ADMIN'),
    $user->tokenResetPassword()->get()->first()->token
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
                      <td style="word-wrap:break-word;font-size:0px;padding:30px 30px 18px;" align="left">
                        <div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:24px;line-height:22px;text-align:left;">Redefinir Senha</div>
                      </td>
                    </tr>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0px;padding:0px 30px 16px;" align="left">
                        <div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;line-height:22px;text-align:left;">Olá <b>{{ $user->name }}</b></div>
                      </td>
                    </tr>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0px;padding:0px 30px 6px;" align="left">
                        <div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;line-height:22px;text-align:left;">Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta.</div>
                      </td>
                    </tr>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0px;padding:8px 16px 10px;padding-bottom:16px;padding-right:30px;padding-left:30px;" align="left">
                        <table role="presentation" cellpadding="0" cellspacing="0" style="border-collapse:separate;" align="left" border="0">
                          <tbody>
                            <tr>
                              <td style="border:none;border-radius:25px;color:white;cursor:auto;padding:10px 25px;" align="center" valign="middle" bgcolor="#00a8ff">
                                <a href="{{ $urlToken }}" target="_blank" style="text-decoration:none;background:#00a8ff;color:white;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;font-weight:400;line-height:120%;text-transform:none;margin:0px;" target="_blank">
                                  Redifinir Senha
                                </a>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0px;padding:0px 30px 30px 30px;" align="left">
                        <div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:13px;line-height:26px;text-align:left;">Se você não solicitou uma redefinição de senha, nenhuma outra ação será necessária.
                          
                            Se você está tendo problemas para clicar no botão "Redefinir senha", copie e cole o URL abaixo em seu navegador da web: <a href="{{ $urlToken }}" target="_blank">{{ $urlToken }}</a>
                          </div>
                      </td>
                    </tr>
                    <tr>
                      <td style="word-wrap:break-word;font-size:0px;padding:0px 30px 30px 30px;" align="left">
                        <div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;line-height:22px;text-align:left;">Se você não solicitou uma redefinição de senha, nenhuma outra ação será necessária.
                          <br> <br> 
                          Atenciosamente, <br> 
                          {{ env('APP_NAME') }}
                          <br/> 
                          <br/> 
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
