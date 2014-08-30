<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

$form = $this->form;
?>
<form class="uk-form" id='inventory-form' name='inventory-form' method='post' action='<?php echo $this->action; ?>'>
    <div>
        <?php foreach ($form->getFieldsets('basic') as $fieldsets => $fieldset): ?>
            <fieldset class="<?php echo $fieldset->name.'_jform_fieldset_label'; ?>" data-uk-margin>
                <?php echo JHtml::_('form.token'); ?>
                <div class='uk-grid'>
                    <?php foreach($form->getFieldset($fieldset->name) as $field):
                        ?>
                        <div class='uk-width-large-1-6 uk-margin-small-top uk-form-small'>
                            <?php
                            if ($field->hidden):
                                // If the field is hidden, only use the input.
                                echo $field->input;
                            else:
                                echo $field->label;
                                echo $field->input;
                            endif;
                            ?>
                        </div>
                    <?php
                    endforeach;
                    ?>
                    <div style="padding-top:15px;">
                        <button class='uk-button uk-button-secondary'><?php echo JText::_('Search'); ?></button>
                        <a class='uk-button' style="margin: 9px 0 0 10px;" href="<?php echo $this->reset; ?>"><?php echo JText::_('Reset'); ?></a>
                    </div>
                </div>

            </fieldset>
        <?php endforeach; ?>
    </div>
</form>