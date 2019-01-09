<?php

namespace Paylatergroup\Translation;


interface ITranslation
{
    public function translate($type = null);

    public function setLanguageCode($code);

    public function setTranslationKey($code);

    public function setOptions($options);
}