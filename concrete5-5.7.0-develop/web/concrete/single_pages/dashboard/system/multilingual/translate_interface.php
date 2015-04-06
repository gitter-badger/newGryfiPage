<?php defined('C5_EXECUTE') or die('Access Denied.');

/* @var $this PageView */

$valt = Loader::helper('validation/token');

if ($this->controller->getTask() == 'translate_po') {

    /* @var $section \Concrete\Core\Multilingual\Page\Section\Section */
    ?>
    <script>
    $(document).ready(function() {
      ccmTranslator.setI18NDictionart({
        AskDiscardDirtyTranslation: <?php echo json_encode(t("The current item has changed.\nIf you proceed you will lose your changes.\n\nDo you want to proceed anyway?")); ?>,
        Comments: <?php echo json_encode(t('Comments')); ?>,
        Context: <?php echo json_encode(t('Context')); ?>,
        ExamplePH: <?php echo json_encode(t('Example: %s')); ?>,
        Filter: <?php echo json_encode(t('Filter')); ?>,
        Original_String: <?php echo json_encode(t('Original String')); ?>,
        Please_fill_in_all_plurals: <?php echo json_encode(t('Please fill-in all plural forms')); ?>,
        Plural_Original_String: <?php echo json_encode(t('Plural Original String')); ?>,
        References: <?php echo json_encode(t('References')); ?>,
        Save_and_Continue: <?php echo json_encode(t('Save & Continue')); ?>,
        Search_for_: <?php echo json_encode(t('Search for...')); ?>,
        Search_in_contexts: <?php echo json_encode(t('Search in contexts')); ?>,
        Search_in_originals: <?php echo json_encode(t('Search in originals')); ?>,
        Search_in_translations: <?php echo json_encode(t('Search in translations')); ?>,
        Show_approved: <?php echo json_encode(t('Show approved')); ?>,
        Show_translated: <?php echo json_encode(t('Show translated')); ?>,
        Show_unapproved: <?php echo json_encode(t('Show unapproved')); ?>,
        Show_untranslated: <?php echo json_encode(t('Show untranslated')); ?>,
        Singular_Original_String: <?php echo json_encode(t('Singular Original String')); ?>,
        Toggle_Dropdown: <?php echo json_encode(t('Toggle Dropdown')); ?>,
        TAB: <?php echo json_encode(t('[TAB] Forward')); ?>,
        TAB_SHIFT: <?php echo json_encode(t('[SHIFT]+[TAB] Backward')); ?>,
        Translate: <?php echo json_encode(t('Translate')); ?>,
        Translation: <?php echo json_encode(t('Translation')); ?>,
        PluralNames: {
          zero: <?php echo json_encode(tc('PluralCase', 'Zero')); ?>,
          one: <?php echo json_encode(tc('PluralCase', 'One')); ?>,
          two: <?php echo json_encode(tc('PluralCase', 'Two')); ?>,
          few: <?php echo json_encode(tc('PluralCase', 'Few')); ?>,
          many: <?php echo json_encode(tc('PluralCase', 'Many')); ?>,
          other: <?php echo json_encode(tc('PluralCase', 'Other')); ?>
        }
      });
      ccmTranslator.initialize({
        container: '#ccm-translator-interface',
        height: $(window).height() - 300,
        saveAction: <?php echo json_encode($this->action('save_translation')); ?>,
        plurals: <?php echo json_encode($section->getPluralsCases()); ?>,
        translations: <?php echo json_encode($translations, $jsonOptions); ?>,
        fuzzySupport: false
      })
    });
    </script>
    <div id="ccm-translator-interface" class="ccm-translator"></div>

    <div class="ccm-dashboard-header-buttons">
        <a href="<?php echo $controller->action('view'); ?>" class="btn btn-default"><?php echo t('Back to List'); ?></a>
    </div>
    <?php

} else {

    if (!is_dir(DIR_LANGUAGES_SITE_INTERFACE) || !is_writable(DIR_LANGUAGES_SITE_INTERFACE)) {
        ?><div class="alert alert-warning"><?php echo t('You must create the directory %s and make it writable before you may run this tool. Additionally, all files within this directory must be writable.', DIR_LANGUAGES_SITE_INTERFACE); ?></div><?php
    }
    $nav = Loader::helper('navigation');
    Loader::model('section', 'multilingual');
    $pages = \Concrete\Core\Multilingual\Page\Section\Section::getList();
    $defaultSourceLocale = Config::get('concrete.multilingual.default_source_locale');

    $ch = Core::make('multilingual/interface/flag');
    $dh = Core::make('helper/date');
    if (count($pages) > 0) {
        ?>
        <div class="ccm-dashboard-content-full">
            <div class="table-responsive">
                <table class="ccm-search-results-table">
                    <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th><span><?php echo t('Name'); ?></span></th>
                        <th><span><?php echo t('Locale'); ?></span></th>
                        <th colspan="2"><span><?php echo t('Completion'); ?></span></th>
                        <th><span><?php echo t('Last Updated'); ?></span></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody><?php
                        foreach ($pages as $pc) {
                            $pcl = \Concrete\Core\Multilingual\Page\Section\Section::getByID($pc->getCollectionID());
                            ?><tr>
                                <td><?php echo $ch->getSectionFlagIcon($pc); ?></td>
                                <td><a href="<?php echo $nav->getLinkToCollection($pc); ?>"><?php echo $pc->getCollectionName(); ?></a></td>
                                <td style="white-space: nowrap"><?php
                                    echo $pc->getLocale();
                                    if ($pc->getLocale() != $defaultSourceLocale) {
                                        ?><a href="#" class="icon-link launch-tooltip" title="<?php echo REL_DIR_LANGUAGES_SITE_INTERFACE; ?>/<?php echo $pc->getLocale(); ?>.mo"><i class="fa fa-question-circle"></i></a><?php
                                    }
                                ?></td>
                                <td style="width: 40%"><?php
                                    if ($pc->getLocale() != $defaultSourceLocale) {
                                        $data = $extractor->getSectionSiteInterfaceCompletionData($pc);
                                        ?><div class="progress">
                                            <div class="progress-bar" style="width: <?php echo $data['completionPercentage']; ?>%">&nbsp;</div>
                                        </div><?php
                                    }
                                ?></td>
                                <td style="white-space: nowrap"><?php
                                    if ($pc->getLocale() != $defaultSourceLocale) {
                                        ?>
                                        <span class="percent"><?php echo $data['completionPercentage']; ?>%</span>
                                        -
                                        <?php echo t(/*i18n: %1$s is the partial number, %2$s is the total number. Example: 2 of 3 */'%1$s of %2$s', '<span class="translated">'.$data['translatedCount'].'</span>', '<span class="total">'.$data['messageCount'].'</span>'); ?>
                                        <?php
                                    }
                                ?></td>
                                <td><?php
                                    if ($pc->getLocale() != $defaultSourceLocale) {
                                        if (file_exists(DIR_LANGUAGES_SITE_INTERFACE.'/'.$pc->getLocale().'.mo')) {
                                            echo $dh->formatDateTime(filemtime(DIR_LANGUAGES_SITE_INTERFACE.'/'.$pc->getLocale().'.mo'), true);
                                        } else {
                                            echo t('File not found.');
                                        }
                                    } else {
                                        echo t('N/A');
                                    }
                                ?></td>
                                <?php
                                if ($pc->getLocale() == $defaultSourceLocale) {
                                    ?><td></td><?php
                                } else {
                                    ?><td><a href="<?php echo $this->action('translate_po', $pc->getCollectionID()); ?>" class="icon-link"><i class="fa fa-pencil"></i></a></td><?php
                                }
                                ?>
                            </tr><?php
                        }
                    ?></tbody>
                </table>
            </div>
        </div>

        <?php
        if (is_dir(DIR_LANGUAGES_SITE_INTERFACE) && is_writable(DIR_LANGUAGES_SITE_INTERFACE)) {
            ?>
            <form method="post" action="<?php echo $controller->action('submit'); ?>">
                <div class="ccm-dashboard-header-buttons btn-group">
                    <button class="btn btn-default" type="submit" name="action" value="reload"><?php echo t('Reload Strings'); ?></button>
                    <button class="btn btn-default" type="submit" name="action" value="export"><?php echo t('Export to .PO'); ?></button>
                    <?php echo $valt->output(); ?>
                    <button class="btn btn-danger" type="button" data-dialog="reset" value="reset"><?php echo t('Reset All'); ?></button>
                </div>
            </form>

            <div style="display: none">
                <div id="ccm-dialog-reset-languages" class="ccm-ui"><?php
                    $u = new User();
                    if ($u->isSuperUser()) {
                        ?>
                        <form method="post" class="form-stacked" style="padding-left: 0px" action="<?php echo $view->action('reset_languages'); ?>">
                            <?php echo Loader::helper("validation/token")->output('reset_languages'); ?>
                            <p><?php echo t('Are you sure? This will remove all translations from all languages, in the database and in your site PO files. This cannot be undone.'); ?></p>
                        </form>
                        <div class="dialog-buttons">
                            <button class="btn btn-default pull-left" onclick="jQuery.fn.dialog.closeTop()"><?php echo t('Cancel'); ?></button>
                            <button class="btn btn-danger pull-right" onclick="$('#ccm-dialog-reset-languages form').submit()"><?php echo t('Confirm Reset'); ?></button>
                        </div>
                        <?php
                    } else {
                        ?><p><?php echo t('Only the admin user may reset all languages.'); ?></p><?php
                    }
                ?></div>
            </div>

            <script type="text/javascript">
                $(function() {
                    $('button[data-dialog=reset]').on('click', function() {
                        jQuery.fn.dialog.open({
                            element: '#ccm-dialog-reset-languages',
                            modal: true,
                            width: 320,
                            title: <?php echo json_encode(t('Reset Languages')); ?>,
                            height: 'auto',
                            resizable: false
                        });
                    });
                });
            </script>
            <?php
        }
        ?>

        <style type="text/css">
            table.ccm-search-results-table div.progress {
                margin-bottom: 0px;
            }
        </style>

        <?php
    } else {
        ?><p><?php echo t('You have not created any multilingual content sections yet.'); ?></p><?php
    }

}