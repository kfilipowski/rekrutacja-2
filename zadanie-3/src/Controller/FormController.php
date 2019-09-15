<?php

namespace App\Controller;

use Smarty;
use App\Model\Form;
use App\Service\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class FormController
{
    /** @var Smarty */
    private $smarty;

    /** @var ValidatorInterface */
    private $validator;

    /**
     * FormController constructor.
     * @param Smarty $smarty
     * @param ValidatorInterface $validator
     */
    public function __construct(Smarty $smarty, ValidatorInterface $validator)
    {
        $this->smarty    = $smarty;
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     * @throws \SmartyException
     */
    public function index(Request $request, SessionInterface $session)
    {
        $data = $this->resolveData(
            $request,
            $session
        );

        $form = new Form(
            $data['name'] ?? null,
            $data['sex'] ?? null,
            $data['age'] ?? null,
            $data['color'] ?? null,
            $data['can_swim'] ?? null,
        );

        $this->smarty->assign([
            'form'    => $form,
            'errors'  => $this->validator->getErrors()
        ]);

        $content = $this->smarty->fetch('../templates/index.tpl');
        return new Response($content);
    }

    /**
     * @param Request $request
     * @param SessionInterface $session
     * @return array
     */
    private function resolveData(Request $request, SessionInterface $session): array
    {
        $requestData = $request->request->all();

        if ($request->request->has('swim')) {
            $hasSwim = $request->request->has('can_swim');
            $requestData['can_swim'] = $hasSwim;
        }

        if ($request->request->has('reset')) {
            $session->remove('data');
            $requestData = [];
        }

        $data = $session->get('data') ?? [];

        if ($this->validator->check($requestData)) {
            $data = array_merge(
                $session->get('data') ?? [],
                $requestData
            );
            $session->set('data', $data);
        }
        return $data;
    }
}
