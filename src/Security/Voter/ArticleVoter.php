<?php

namespace App\Security\Voter;

use App\Entity\Article;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class ArticleVoter extends Voter
{
    public const EDIT = 'ARTICLE_POST_EDIT';
    public const DELETE = 'ARTICLE_POST_DELETE';
    public const CREATE = 'ARTICLE_POST_CREATE';

    public function __construct(private readonly Security $security) {}

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [self::EDIT, self::DELETE, self::CREATE])
            && $subject instanceof Article;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        return match ($attribute) {
            self::DELETE, self::EDIT => $subject->getUser() === $user || $this->security->isGranted('ROLE_ADMIN'),
            self::CREATE => $this->security->isGranted('IS_AUTHENTICATED', $token),
            default => false,
        };
    }
}
