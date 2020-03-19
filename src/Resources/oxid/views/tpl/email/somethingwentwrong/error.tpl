<h1>Fehler im Shop entdeckt</h1>

<p>Ein Besucher wurde im Shop unerwartet weitergeleitet.</p>

[{if $oxcmp_basket->getProductsCount()}]
[{assign var="currency" value=$oView->getActCurrency()}]
<h3>[{$oxcmp_basket->getItemsCount()}] [{oxmultilang ident="ITEMS_IN_BASKET"}]</h3>

<table width="100%" class="table table-bordered table-striped">
    [{foreach from=$oxcmp_basket->getContents() name=miniBasketList item=_product}]
        [{assign var="minibasketItemTitle" value=$_product->getTitle()}]
        <tr>
            <td class="picture text-center">
                <span class="badge">[{$_product->getAmount()}]</span>
                <a href="[{$_product->getLink()}]" title="[{$minibasketItemTitle|strip_tags}]">
                    <img src="[{$_product->getIconUrl()}]" alt="[{$minibasketItemTitle|strip_tags}]"/>
                </a>
            </td>
            <td class="title">
                <a href="[{$_product->getLink()}]" title="[{$minibasketItemTitle|strip_tags}]">[{$minibasketItemTitle|strip_tags}]</a>
            </td>
            <td class="price text-right">[{oxprice price=$_product->getPrice() currency=$currency}]</td>
        </tr>
    [{/foreach}]
</table>

<table width="100%" class="table table-striped">
    <tr>
        <td class="total_label" colspan="2">
            <strong>[{oxmultilang ident="TOTAL"}]</strong>
        </td>
        <td class="total_price text-right">
            <strong>
                [{if $oxcmp_basket->isPriceViewModeNetto()}]
                    [{$oxcmp_basket->getProductsNetPrice()}]
                [{else}]
                    [{$oxcmp_basket->getFProductsPrice()}]
                [{/if}]
                &nbsp;[{$currency->sign}]
            </strong>
        </td>
    </tr>
</table>

[{/if}]

[{if !empty($USER)}]
<h3>User-Daten</h3>

<div style="padding-top:10px;padding-left:10px;padding-right:10px;padding-bottom:10px;background:#EEEEEE;">
<table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;">
    [{foreach from=$USER key=key item=value}]
    <tr>
        <td height="25" style="border-bottom:1px solid #999999;" width="150">[{$key}]:&nbsp;</td><td style="border-bottom:1px solid #999999;">[{$value}]&nbsp;</td>
    </tr>
    [{/foreach}]
</table>
</div>

[{/if}][{*}]
<h3>Server-Daten:</h3>

<div style="padding-top:10px;padding-left:10px;padding-right:10px;padding-bottom:10px;background:#EEEEEE;">
<table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;">
    [{foreach from=$SERVER key=key item=value}]
    <tr>
        <td height="25" style="border-bottom:1px solid #999999;" width="150">[{$key}]:&nbsp;</td><td style="border-bottom:1px solid #999999;">[{$value}]&nbsp;</td>
    </tr>
    [{/foreach}]
</table>
</div>[{*}]

<h3>Server-Historie:</h3>

[{foreach from=$SERVER_HISTORY item=history}]
<div style="padding-top:10px;padding-left:10px;padding-right:10px;padding-bottom:10px;background:#EEEEEE;">
    <h4>[{$history.TIMESTAMP|date_format:"%d.%m.%Y, %H:%M:%S"}]</h4>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;">
        <tr>
            <td>
                <a href="[{$history.HTTP_HOST}][{$history.REQUEST_URI}]">Initialer Aufruf</a>
            </td>
            <td>
                <a href="[{$history.HTTP_HOST}]?[{$history.QUERY_STRING|ltrim:"&"|ltrim:"?"}]">Direkte weiterleitung</a>
            </td>
        </tr>
        [{foreach from=$history key=key item=value}]
        <tr>
            <td height="25" style="border-bottom:1px solid #999999;" width="150">[{$key}]:&nbsp;</td><td style="border-bottom:1px solid #999999;">[{$value}]&nbsp;</td>
        </tr>
        [{/foreach}]
    </table>
</div>
[{/foreach}]
