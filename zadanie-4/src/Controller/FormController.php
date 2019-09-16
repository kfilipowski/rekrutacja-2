<?php

namespace App\Controller;

use Smarty;
use App\Model\Form;
use App\Service\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @return Response
     * @throws \SmartyException
     */
    public function index()
    {
        $content = $this->smarty->fetch('../templates/index.tpl');
        return new Response($content);
    }

    /**
     * @param Request $request
     * @param SessionInterface $session
     * @return JsonResponse
     * @throws \SmartyException
     */
    public function form(Request $request, SessionInterface $session): JsonResponse
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
            'form'   => $form,
            'errors' => $this->validator->getErrors()
        ]);

        $content = $this->smarty->fetch('../templates/_form.tpl');
        return new JsonResponse($content);
    }

    /**
     * @param Request $request
     * @param SessionInterface $session
     * @return array
     */
    private function resolveData(Request $request, SessionInterface $session): array
    {
        $requestData = $request->query->all();

        if ($request->query->has('swim')) {
            $hasSwim = $request->query->has('can_swim');
            $requestData['can_swim'] = $hasSwim;
        }

        if ($request->query->has('reset')) {
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
