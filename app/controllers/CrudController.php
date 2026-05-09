<?php

declare(strict_types=1);

class CrudController
{
    private Pizza $pizzaModel;

    public function __construct()
    {
        $this->pizzaModel = new Pizza();
    }

    public function index(): void
    {
        $items = $this->pizzaModel->all();
        $editing = null;

        if (isset($_GET['id'])) {
            $editing = $this->pizzaModel->find((int)$_GET['id']);
        }

        View::render('crud/index', ['items' => $items, 'editing' => $editing]);
    }

    public function create(): void
    {
        $this->pizzaModel->create($this->payload());
        View::redirect('crud');
    }

    public function edit(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        $this->pizzaModel->update($id, $this->payload());
        View::redirect('crud');
    }

    public function delete(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        $this->pizzaModel->delete($id);
        View::redirect('crud');
    }

    private function payload(): array
    {
        return [
            'pizza_name' => trim($_POST['pizza_name'] ?? ''),
            'category_name' => trim($_POST['category_name'] ?? ''),
            'vegetarian' => isset($_POST['vegetarian']) ? 1 : 0,
        ];
    }
}
