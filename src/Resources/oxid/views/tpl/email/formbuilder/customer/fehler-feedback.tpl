[{assign var="shop"           value=$oEmailView->getShop()}]
[{assign var="oViewConf"      value=$oEmailView->getViewConfig()}]
[{assign var="oConf"          value=$oViewConf->getConfig()}]
[{assign var="currency"       value=$oEmailView->getCurrency()}]
[{assign var="user"           value=$oEmailView->getUser()}]
[{assign var="oOrderFileList" value=$oEmailView->getOrderFileList($sOrderId)}]

[{capture assign="style"}]
    table.formbuilder {
        width: 100%;
    }
[{/capture}]

[{include file="email/html/header.tpl" title=$form.oxtitle style=$style}]

<h1>Vielen Dank für Ihr Feedback</h1>

<p>Vielen Dank für Ihr Feedback. Wir werden uns in Kürze mit Ihnen in Verbindung setzen.</p>
<p>Sie erhalten diese E-Mail als Bestätigung Ihres Feedbacks, mit einer Kopie Ihrer Angaben:</p>

[{block name="formbuilder_feedback_email_before"}][{/block}]
<table class="formbuilder" width="100%" style="width:100%;">
    [{block name="formbuilder_feedback_email_start"}][{/block}]
    <tr>
        <td>E-Mail-Adresse:</td>
        <td>[{$feedback_email}]</td>
    </tr>
    <tr>
        <td>Anliegen:</td>
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