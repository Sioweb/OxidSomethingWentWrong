[{assign var="shop"           value=$oEmailView->getShop()}]
[{assign var="oViewConf"      value=$oEmailView->getViewConfig()}]
[{assign var="oConf"          value=$oViewConf->getConfig()}]
[{assign var="currency"       value=$oEmailView->getCurrency()}]
[{assign var="user"           value=$oEmailView->getUser()}]
[{assign var="oOrderFileList" value=$oEmailView->getOrderFileList($sOrderId)}]

[{include file="email/html/header.tpl" title=$form.oxtitle style=$style}]

[{block name="formbuilder_feedback_email_before"}][{/block}]
<h1>Ein neues Feedback aus dem Onlineshop:</h1>

<table class="formbuilder" width="100%" style="width:100%;">
    [{block name="formbuilder_feedback_email_start"}][{/block}]
    <tr>
        <td>Absender:</td>
        <td>[{$feedback_email}]</td>
    </tr>
    <tr>
        <td>Telefon:</td>
        <td>[{$feedback_phone}]</td>
    </tr>
    <tr>
        <td colspan="2">Feedback</td>
    </tr>
    <tr>
        <td colspan="2">[{ $feedback|nl2br }]</td>
    </tr>
    [{block name="formbuilder_feedback_email_end"}][{/block}]
</table>
[{block name="formbuilder_feedback_email_after"}][{/block}]
<br><br>

[{include file="email/html/footer.tpl"}]