<?php
namespace App\Security;

use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\String\AbstractUnicodeString;
use Symfony\Component\String\UnicodeString;
use function Symfony\Component\String\u;

final class NormalizedUserBadge extends UserBadge
{
    public function __construct(string $identifier)
    {
        $callback = static fn (string $identifier): string => u($identifier)->normalize(AbstractUnicodeString::NFKC)->ascii()->lower()->toString();

        parent::__construct($identifier, null, $callback);
    }
}
