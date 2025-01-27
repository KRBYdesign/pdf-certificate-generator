<?php

namespace App;

class HtmlTemplate
{
    private array $fieldContents;

    private string $template;

    private string $contents;

    public function __construct(string $recipient, array $fieldContents, string $template)
    {
        $this->fieldContents = $fieldContents;
        $this->template = $template;

        $this->fieldContents['recipient'] = $recipient;

        $this->contents = $this->setContents();
    }

    private function getTemplateContents(): string
    {
        return file_get_contents('../storage/templates/certificates/' . $this->template . '.html');
    }

    private function setContents(): string
    {
        $templateContents = $this->getTemplateContents();

        return $this->replaceTemplateContents($templateContents, $this->fieldContents);
    }

    public function render(): string
    {
        return $this->contents;
    }

    private function replaceTemplateContents(string $contents, array $replacements): string
    {
        foreach ($replacements as $key => $value) {
            $contents = str_replace("{{ $key }}", $value, $contents);
        }

        return $contents;
    }
}