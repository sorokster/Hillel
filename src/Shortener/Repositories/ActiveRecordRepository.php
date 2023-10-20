<?php declare(strict_types=1);

namespace Hillel\Project\Shortener\Repositories;

use Hillel\Project\Core\ORM\ActiveRecord\Models\Code;
use Hillel\Project\Core\ORM\ActiveRecord\Models\Url;
use Hillel\Project\Shortener\Interfaces\IRepository;
use Hillel\Project\Shortener\ValueObjects\UrlCodeValueObject;

class ActiveRecordRepository implements IRepository
{
    /**
     * @param string $code
     * @param string $url
     * @return void
     */
    public function addRecord(string $code, string $url): void
    {
        $urlModel = Url::fromState($url);
        $urlModel->save();
        $urlId = Url::query()->where('url', '=', $url)->first(['id'])->id;
        $codeModel = Code::fromState($urlId, $code);
        $codeModel->save();
    }

    /**
     * @param string $code
     * @return UrlCodeValueObject|null
     */
    public function getRecord(string $code): ?UrlCodeValueObject
    {
        $codeModel = Code::query()->where('code', '=', $code)->first();

        if (empty($codeModel)) {
            return null;
        }

        $url = (string)$codeModel->url->value('url');
        if (empty($url)) {
            return null;
        }

        return new UrlCodeValueObject($url, $code);
    }
}
