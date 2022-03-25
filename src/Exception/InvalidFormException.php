<?php
namespace App\Exception;
use Exception;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;


class InvalidFormException extends Exception
{
    /**
     * @var FormInterface
     */
    private FormInterface $form;

    private array $errors;

    /**
     * InvalidFormException constructor.
     * @param FormInterface $form
     */
    public function __construct(FormInterface $form)
    {
        $this->form = $form;


        $this->transformErrors();
        parent::__construct("INVALID_FORM_EXCEPTION", Response::HTTP_BAD_REQUEST);

    }

    public function transformErrors() {
        $errors = [];
        foreach ($this->form->getErrors() as $error) {
            $errors['form'][] = $error->getMessage();
        }
        foreach ($this->form as $formField) {
            $name = $formField->getName();
            foreach ($formField->getErrors(true) as $error) {
                $errors[$name][] = $error->getMessage();
            }
        }

        $this->errors = $errors;
    }

    /**
     * @return FormInterface
     */
    public function getForm(): FormInterface
    {
        return $this->form;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }


}
