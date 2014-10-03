<?php
/**
 * Created by PhpStorm.
 * User: charles
 * Date: 03/10/14
 * Time: 12:32
 */

use \dcp\Family\Attribute\Structure as Struct;
use \dcp\Family\Attribute\Attribute as Attr;
use \dcp\Family\Attribute\ChildrenSet as ChildrenSet;
use \dcp\Family\Attribute\Options as Options;
use \dcp\Family\Attribute\ParentAttribute as ParentAttribute;

class MY_FAMILY extends \dcp\Family\Definition
{

    public function defineStruct()
    {
        parent::defineStruct();
        $this->struct
            ->before("df_f_first")
            ->add(new Struct("ff_f_desc", Struct::frame, new ChildrenSet([
                new Attr("ff_title", Attr::test, new Options([
                    Options::inTitle => true,
                    Options::defaultValue => "Du contenu",
                    "enum" => "Testounet",
                    "whatisthat" => "toutou"
                ])),
                new Attr("ff_creator", Attr::account, new Options([
                    Options::helper => array(
                        "file" => "HelperOfTheProject.php",
                        "function" => "MyHelper(CT):ff_creator"
                    ),
                    Options::defaultValue => self::getUserId
                ])),
                new Struct("ff_a_redactors", Struct::arrayType, new ChildrenSet([
                    new Attr("ff_redactor", Attr::account)
                ]), new Options([
                    Options::label => "up"
                ]))
            ])))->parentStruct("df_a_files", new ChildrenSet(
                new ParentAttribute("df_file"),
                new Attr("ff_creator", Attr::account),
                new Attr("df_file_date", Attr::inherited, new Options([
                    Options::defaultValue => self::getDate
                ]))
            ));

    }
} 