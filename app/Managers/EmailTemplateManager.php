<?php

namespace App\Managers;

use App\Enums\EmailTemplateAttachmentEnum;
use App\Models\EmailTemplate;

class EmailTemplateManager
{
    public function create(array $data): EmailTemplate
    {
        /** @var EmailTemplate $item */
        $item = EmailTemplate::query()->create([
            'title' => $data['title'],
            'content' => $data['content'],
        ]);

        if ($data['statuses']) {
            foreach ($data['statuses'] as $status) {
                $item->statuses()->create([
                    'application_status_type' => $status,
                ]);
            }
        }

        if ($data['attachments']) {
            foreach ($data['attachments'] as $attachment) {
                $item->attachments()->create([
                    'key' => $attachment
                ]);
            }
        }

        return $item;
    }

    public function update(EmailTemplate $emailTemplate, array $data): void
    {
        $emailTemplate->update([
            'title' => $data['title'],
            'content' => $data['content'],
        ]);

        $emailTemplate->statuses()->delete();
        $emailTemplate->attachments()->delete();

        if ($data['statuses']) {
            foreach ($data['statuses'] as $status) {
                $emailTemplate->statuses()->create([
                    'application_status_type' => $status,
                ]);
            }
        }

        if ($data['attachments']) {
            foreach ($data['attachments'] as $attachment) {
                $emailTemplate->attachments()->create([
                    'key' => $attachment
                ]);
            }
        }
    }

    public function delete(EmailTemplate $emailTemplate): void
    {
        $emailTemplate->delete();
    }
}
