<?php

namespace App\Services\Telegram;

final class TelegramMessage
{
    private string $messageText;

    private array $mediaFiles = [];

    public function __construct($messageText = null)
    {
        $this->messageText = $messageText ?? '';

        return $this;
    }

    public function addPhoto(string $photoUrl): self
    {
        $this->mediaFiles[] = $photoUrl;

        return $this;
    }

    public function addVideo(string $videoUrl): self
    {
        $this->mediaFiles[] = $videoUrl;

        return $this;
    }

    public function prependText(string $textToPrepend): self
    {
        $this->messageText = $textToPrepend . PHP_EOL . $this->messageText;

        return $this;
    }

    public function appendText(string $textToAppend): self
    {
        $this->messageText .= $textToAppend . PHP_EOL;

        return $this;
    }

    public function hasMediaFiles(): bool
    {
        return !empty($this->mediaFiles);
    }

    public function getText(): string
    {
        return $this->messageText;
    }

    public function getMediaFiles(): array
    {
        return $this->mediaFiles;
    }
}
