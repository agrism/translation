<?php

namespace Paylatergroup\Translation\Services;


abstract class Service
{
    protected $languageCode;

    protected $translationKey;

    protected $options = [];

    protected $translation = '';

    public function translate($type = null)
    {

        $this->getData()->replaceOptions();

        $translation = $this->translationKey;

        if (empty($this->translation->translation)) {

            if (empty($this->translation->text)) {

                $this->insertNewData();

            } else {

                $translation = $this->translation->text;
            }
        } else {

            $translation = $this->translation->translation;
        }

        echo $translation;
    }

    public function setLanguageCode($code)
    {
        if(!empty($code)){
            $this->languageCode = $code;
        }

        return $this;
    }

    public function setTranslationKey($translationKey)
    {
        $this->translationKey = $translationKey;
        return $this;
    }

    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    abstract protected function getData();

    protected function replaceOptions()
    {
        if(empty($this->translation->options)){
            return $this;
        }

        foreach (json_decode($this->translation->options) as $replacementKey) {

            $this->translation->translation = str_replace($replacementKey, !empty($this->options[$replacementKey]) ? $this->options[$replacementKey] : '', $this->translation->translation);
        }

        return $this;
    }

    abstract protected function insertNewData();
}