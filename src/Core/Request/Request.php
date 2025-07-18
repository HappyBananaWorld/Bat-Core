<?php

namespace Src\Core\Request;

use Nyholm\Psr7\ServerRequest as Psr7Request;
use Nyholm\Psr7\ServerRequest;

class Request extends Psr7Request
{
    public static function fromPsr7(ServerRequest $request): self
    {
        return new self(
            $request->getMethod(),
            $request->getUri(),
            $request->getHeaders(),
            $request->getBody(),
            $request->getProtocolVersion(),
            $request->getServerParams()
        );
    }

    /**
     * Get an input item from the request.
     *
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    public function input(?string $key = null, $default = null)
    {
        // اول داده‌های فرم رو بگیر
        $data = $this->getParsedBody();

        // اگر داده‌های فرم نبود یا خالی بود، سعی کنیم JSON decode کنیم
        if (empty($data)) {
            $body = (string) $this->getBody();
            $data = json_decode($body, true) ?: [];
        }

        // اگه کلید داده نشده، کل داده‌ها رو برگردون
        if ($key === null) {
            return $data;
        }

        // اگر کلید هست ولی مقدارش نیست، مقدار پیش‌فرض رو بده
        return $data[$key] ?? $default;
    }
}
