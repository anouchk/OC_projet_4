<?php
namespace App\Service;
use Symfony\Component\HttpFoundation\RequestStack;

class StripeEmailCatcher
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * StripeEmailCatcher constructor.
     *
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function getEmail()
    {
        return $this->requestStack->getCurrentRequest()->request->get('stripeEmail');
    }
} 