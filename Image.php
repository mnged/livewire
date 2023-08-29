<?php

namespace App\Http\Livewire;


use Livewire\Component;
use App\Models\Imagesss;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class Image extends Component
{
    use WithFileUploads;


    public $showData = true;
    public $createData = false;
    public $updateData = false;

    public $name;
    public $email;
    public $message;
    public $image;


    public $old_image;
    public $new_image;
    public $edit_id;
    public $edit_name;
    public $edit_email;
    public $edit_message;


  public function showForm()
  {
      $this->showData = false;
      $this->createData = true;
  }

  public function resetField()
  {
      $this->name = "";
      $this->email = "";
      $this->message = "";
      $this->image = "";
      $this->edit_name = "";
      $this->edit_name = "";
      $this->edit_message = "";
      $this->new_image = "";
      $this->old_image = "";
      $this->edit_id = "";
  }
  protected $rules = [
    'name' => 'required',
          'email' => 'required',
          'message' => 'required',
          'image' => 'required'
];

  public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

  public function create()
  {
      $images = new Imagesss();
      $this->validate([
          'name' => 'required',
          'email' => 'required',
          'message' => 'required',
          'image' => 'required'
      ]);

      $filename = "";
      if ($this->image) {
          $filename = $this->image->store('posts', 'public');
      } else {
          $filename = Null;
      }

      $images->name = $this->name;
      $images->email = $this->email;
      $images->message = $this->message;
      $images->image = $filename;
      $result = $images->save();
      if ($result) {
          session()->flash('success', 'Add Successfully');
          $this->resetField();
          $this->showData = true;
          $this->createData = false;
      } else {
          session()->flash('error', 'Not Add Successfully');
      }
  }



  public function edit($id)
  {
      $this->showData = false;
      $this->updateData = true;
      $images = Imagesss::findOrFail($id);
      $this->edit_id = $images->id;
      $this->edit_name = $images->name;
      $this->edit_email = $images->email;
      $this->edit_message = $images->message;
      $this->old_image = $images->image;
  }

  public function update($id)
  {
      $images =Imagesss::findOrFail($id);
      $this->validate([
          'edit_name' => 'required',
          'edit_email' => 'required',
          'edit_message' => 'required',
      ]);

      $filename = "";
      $destination=public_path('storage\\'.$images->image);
      if ($this->new_image != null) {
          if(File::exists($destination)){
              File::delete($destination);
          }
          $filename = $this->new_image->store('posts', 'public');
      } else {
          $filename = $this->old_image;
      }

      $images->name = $this->edit_name;
      $images->email = $this->edit_email;
      $images->message = $this->edit_message;
      $images->image = $filename;
      $result = $images->save();
      if ($result) {
          session()->flash('success', 'Update Successfully');
          $this->resetField();
          $this->showData = true;
          $this->updateData = false;
      } else {
          session()->flash('error', 'Not Update Successfully');
      }
  }



  public function delete($id)
    {
        $images=Imagesss::findOrFail($id);
        $destination=public_path('storage\\'.$images->images);
        if(File::exists($destination)){
            File::delete($destination);
        }

        $result=$images->delete();
        if ($result) {
            session()->flash('success', 'Delete Successfully');
        } else {
            session()->flash('error', 'Not Delete Successfully');
        }



    }



    public function render()
    {
        $images = Imagesss::orderBy('id', 'DESC')->get();
        return view('livewire.image', ['images' => $images])->layout('layouts.app') ;
    }


}