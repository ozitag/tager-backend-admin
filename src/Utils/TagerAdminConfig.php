<?php

namespace OZiTAG\Tager\Backend\Admin\Utils;

use OZiTAG\Tager\Backend\Fields\Enums\FieldType;
use OZiTAG\Tager\Backend\Fields\Enums\RepeaterView;
use OZiTAG\Tager\Backend\Fields\FieldFactory;
use OZiTAG\Tager\Backend\Fields\Fields\RepeaterField;
use OZiTAG\Tager\Backend\Fields\Base\Field;

class TagerAdminConfig
{
    /**
     * @return array
     */
    private static function config($param = null, $default = [])
    {
        return \config('tager-admin' . ($param ? '.' . $param : ''), $default);
    }

    /**
     * @return Fiel[]
     */
    public static function getFields()
    {
        $fieldsCondig = self::config('fields', []);

        $result = [];

        foreach ($fieldsCondig as $fieldName => $fieldData) {

            $field = FieldFactory::create(
                $fieldData['type'] ?? FieldType::String,
                $fieldData['label'],
                $fieldData['meta'] ?? []
            );

            $field->setName($fieldName);

            if ($field instanceof RepeaterField) {
                $field->setFields($fieldData['fields'] ?? []);
                $field->setViewMode($fieldData['viewMode'] ?? RepeaterView::Table);
            }

            $result[$fieldName] = $field;
        }

        return $result;
    }

    public static function getField(string $name): ?Field
    {
        $fieldsConfig = self::getFields();

        return $fieldsConfig[$name] ?? null;
    }
}
