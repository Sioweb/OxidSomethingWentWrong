<?php

namespace Sioweb\Oxid\SomethingWentWrong\Core;

use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\DbMetaDataHandler;

class Events
{
    public function onActivate() {

        $Database = DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC);
        $dbMetaDataHandler = oxNew(DbMetaDataHandler::class);
        // Setup form elements and form if not exists

        $rs = $Database->select("SELECT OXID FROM ci_form WHERE OXID = ?", ['27ff1f1a74c65f80d52147ec9a18d1c2']);
        
        if ($rs == false || $rs->count() === 0) {
            
            $Database = DatabaseProvider::getDb();
            $Database->execute("
                INSERT INTO `ci_form` (`OXID`, `OXSHOPID`, `OXTITLE`, `OXCSSCLASS`, `OXACTIVE`, `OXACTIVEFROM`, `OXACTIVETO`, `OXSORT`, `OXTIMESTAMP`, `OXACTION`, `OXFIELDCONFIG`, `OXSENDFORM`, `OXRECEIVER`, `OXSUBJECT`, `OXCONTENT`, `OXALIAS`, `OXHTMLTEMPLATE`, `OXCONFIRM`, `OXRECEIVER_CONFIRM`, `OXSUBJECT_CONFIRM`, `OXCONTENT_CONFIRM`, `APPLYFIELDS`, `SUBMIT`, `OXADDATTACHMENTS`, `OXATTACHMENTS`) VALUES
                ('27ff1f1a74c65f80d52147ec9a18d1c2', 1, 'Fehler-Feedback', '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2019-05-23 08:47:36', 'Vielen-dank-fuer-ihr-feedback/', '[{\"legend\":\"\",\"fields\":[\"7bbaf1f11bedbfff7919b52f4401b62f\",\"6fdf77a5a736f88110c61430b1a23f53\",\"6b3ceecafab8dfd9f6441757c253eb97\",\"996731ebdec7f7253546aeae08ce8d34\",\"683e2544c50d6d2088ba04bd91b5a311\"]}]', '1', '', 'Fehler Feedback aus dem Shop', 'Neues Feedback aus dem Onlineshop:\r\n\r\nAbsender: [{".'$feedback_email'."}]\r\nTelefon: [{".'$feedback_phone'."}]\r\nFeedback:\r\n[{".'$feedback'."}]', '\'\'', 'fehler-feedback', '1', '\'\'', 'Vielen Dank, für Ihr Feedback', 'Vielen Dank für Ihr Feedback.\r\n\r\nWir werden Ihr Feedback schnellstmöglich bearbeiten und uns mit Ihnen in Verbindung setzen.\r\n\r\nIhre Daten:\r\n\r\nE-Mail-Adresse: [{".'$feedback_email'."}]\r\nTelefon: [{".'$feedback_phone'."}]\r\nFeedback:\r\n[{".'$feedback'."}]', '\'\'', '\'\'', '0', '\'\'');

                INSERT INTO `ci_form_element` (`OXID`, `OXSHOPID`, `OXTYPE`, `OXTITLE`, `OXVALUE`, `OXCSSCLASS`, `OXACTIVE`, `OXACTIVEFROM`, `OXACTIVETO`, `OXSORT`, `OXTIMESTAMP`, `OXFORMID`, `OXLABEL`, `OXREQUIRED`, `OXVALIDATION`, `OXPLACEHOLDER`, `OXOPTIONS`, `SUBMIT`, `OXCONFIRMFIELD`) VALUES
                ('683e2544c50d6d2088ba04bd91b5a311', 1, 'submit', 'feedback_submit', 'Feedback senden', 'btn', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2019-05-22 13:36:45', '', NULL, NULL, NULL, NULL, 'null', '\'\'', NULL),
                ('6b3ceecafab8dfd9f6441757c253eb97', 1, 'textarea', 'feedback', NULL, NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2019-05-22 07:27:52', '', 'Ihr Feedback', '1', '', '', 'null', '\'\'', '0'),
                ('6fdf77a5a736f88110c61430b1a23f53', 1, 'default', 'feedback_phone', NULL, NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2019-05-22 07:28:43', '', 'Telefon', '0', '', '', 'null', '\'\'', '0'),
                ('7bbaf1f11bedbfff7919b52f4401b62f', 1, 'default', 'feedback_email', NULL, NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2019-05-22 07:27:07', '', 'E-Mail', '0', 'email', '', 'null', '\'\'', '1'),
                ('996731ebdec7f7253546aeae08ce8d34', 1, 'checkbox', 'feedback_dsgvo', NULL, NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2019-05-23 08:47:14', '', 'Datenschutz', '1', '', '', '[{\"key\":\"Ja\",\"value\":\"Ich stimme der Verwendung meiner Daten zur Beantwortung dieser Anfrage und f\\u00fcr statistische Zwecke zu.\"}]', '\'\'', '0');

                INSERT INTO `ci_form_element2form` (`OXID`, `OXELEMENTID`, `OXFORMID`, `OXTIMESTAMP`, `_OXTYPE`, `_OXTITLE`, `_OXLABEL`, `_OXVALUE`, `_OXREQUIRED`, `_OXVALIDATION`, `_OXPLACEHOLDER`, `_OXOPTIONS`, `_OXCONFIRMFIELD`) VALUES
                ('46a4c1e274191b2bf106028a37df27cd', '996731ebdec7f7253546aeae08ce8d34', '27ff1f1a74c65f80d52147ec9a18d1c2', '2019-05-23 08:47:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
                ('61338c43d23496d0ebff0554ad515415', '683e2544c50d6d2088ba04bd91b5a311', '27ff1f1a74c65f80d52147ec9a18d1c2', '2019-05-22 13:05:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
                ('73ad8c1263f1f0c06e22e3ecf9776a6f', '6b3ceecafab8dfd9f6441757c253eb97', '27ff1f1a74c65f80d52147ec9a18d1c2', '2019-05-22 07:35:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
                ('d57ff72085dfb3c03de3ab113ea0a95e', '7bbaf1f11bedbfff7919b52f4401b62f', '27ff1f1a74c65f80d52147ec9a18d1c2', '2019-05-22 07:35:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
                ('ee97767870bc985052e08d97452e1da9', '6fdf77a5a736f88110c61430b1a23f53', '27ff1f1a74c65f80d52147ec9a18d1c2', '2019-05-22 07:35:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
                
                INSERT INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXACTIVE_1`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXTITLE_1`, `OXCONTENT_1`, `OXACTIVE_2`, `OXTITLE_2`, `OXCONTENT_2`, `OXACTIVE_3`, `OXTITLE_3`, `OXCONTENT_3`, `OXCATID`, `OXFOLDER`, `OXTERMVERSION`, `OXTIMESTAMP`, `DDHIDETITLE`, `DDHIDESIDEBAR`, `DDISBLOCK`, `DDBLOCK`, `DDOBJECTTYPE`, `DDOBJECTID`, `DDISLANDING`, `DDISTMPL`, `DDACTIVEFROM`, `DDACTIVEUNTIL`, `DDCSSCLASS`, `DDCUSTOMCSS`, `DDTMPLTARGETID`, `DDTMPLTARGETDATE`, `DDPARENTCONTENT`, `DDSORTING`, `DDFULLWIDTH`, `DDPLAINTEXT`) VALUES
                ('220a140aec65ce0bc6e7cadc1831439f', '52c6a13fa6be729a3f0fc9d1241fe324', 1, 1, 0, 1, 0, '\'\'', 'Feedback Formular (Top)', '<h3>Unerwarteter Fehler</h3><p>Bitte entschuldigen Sie, es ist ein Fehler aufgetreten. Gerne können Sie mit uns in Kontakt treten und wir werden dass Problem umgehend beheben.</p><p>Wir danken Ihnen für Ihr Verständnis!</p>', '', '', 0, '', '', 0, '', '', 'cfc99c773bcca578f01190b77771d93b', '', '\'\'', '2019-05-22 13:23:07', 0, 0, 0, '\'\'', '\'\'', '\'\'', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '\'\'', '', '\'\'', '0000-00-00 00:00:00', '\'\'', 0, 0, 0),
                ('a8cfe3bfef181937f5e1473823e27099', 'f0851024c88164d9e2518e9f4ae346e4', 1, 1, 0, 1, 0, '\'\'', 'Vielen Dank für ihr Feedback', '<p>Wir werden Ihr Feedback schnellstmöglich bearbeiten.<br></p>', '', '', 0, '', '', 0, '', '', 'cfc99c773bcca578f01190b77771d93b', '', '\'\'', '2019-05-23 08:19:45', 0, 0, 0, '\'\'', '\'\'', '\'\'', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '\'\'', '', '\'\'', '0000-00-00 00:00:00', '\'\'', 0, 0, 0);
            ");
        }
    }

    public function onDeactivate() {

    }
}
