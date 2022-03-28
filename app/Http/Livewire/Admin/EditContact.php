<?php

namespace App\Http\Livewire\Admin;

use App\Models\PublicContact;
use Livewire\Component;

class EditContact extends Component
{
    public $name;
    public $email;
    public $subject;
    public $contact_message;
    public $selectedId;

    public function mount(PublicContact $publicContact)
    {
        $this->name = $publicContact->name;
        $this->email = $publicContact->email;
        $this->subject = $publicContact->subject;
        $this->contact_message = $publicContact->message;
        $this->selectedId = $publicContact->id;
    }

    protected function rules()
    {
        return [
            'name'            => 'required|max:64',
            'email'           => 'required|email',
            'subject'         => 'required|max:128',
            'contact_message' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    private function resetForm()
    {
        $this->name = "";
        $this->email = "";
        $this->subject = "";
        $this->message = "";
    }

    public function update()
    {
        $data = $this->validate();

        try {
            $data['message'] = $data['contact_message'];
            unset($data['contact_message']);
            $contact = PublicContact::where('id', $this->selectedId)->firstOrFail();
            $contact->update($data);
        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', "Data gagal di perbarui: {$e->getMessage()}");

            return;
        }
        $this->resetForm();

        $this->emit('showAlert', 'success', "Data berhasil di perbarui.");

        return to_route('admin.contact');
    }

    public function render()
    {
        return view('livewire.admin.edit-contact')->layout('livewire.layouts.main', ['href' => 'Manage Users', 'name' => 'Contact']);
    }
}
