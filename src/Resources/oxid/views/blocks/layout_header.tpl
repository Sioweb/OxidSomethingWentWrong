[{$smarty.block.parent}]
[{if $oView->getClassName() == "start" && $oView->somethingWentWrong()}]
    <div class="feedback-formbuilder-outer">
        <form class="formbuilder feedback-formbuilder" action="/index.php?cl=formbuilder&fid=27ff1f1a74c65f80d52147ec9a18d1c2" method="post">
            <a href="[{ $oViewConf->getBaseDir() }]" class="feedback-close">×</a>
            [{oxcontent ident="52c6a13fa6be729a3f0fc9d1241fe324"}]
            [{$oView->getFeedbackForm()}]
        </form>
    </div>
    [{oxscript add='$(".feedback-close").click(function() {$(this).closest(".feedback-formbuilder-outer").remove();})'}]
[{/if}]