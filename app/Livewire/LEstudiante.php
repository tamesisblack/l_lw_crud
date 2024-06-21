<?php

namespace App\Livewire;

use App\Models\Estudiante;
use Livewire\Component;

class LEstudiante extends Component
{
    public $cursoId;
    public $estudianteId;
    public $nombre;
    public $direccion;
    public $edad;
    // protected $listeners = [
    //     'openEditarModal' => 'openEditarModal',
    // ];
    
    public function render()
    {
        $estudiantes = Estudiante::all();
        return view('livewire.l-estudiante', ["estudiantes" => $estudiantes]);
    }
    public function openEditarModal($estudianteId)
    {
        $this->estudianteId = $estudianteId;
        $estudiante         = Estudiante::find($estudianteId);
        $this->nombre       = $estudiante->nombres;
        $this->direccion    = $estudiante->direccion;
        $this->edad         = $estudiante->edad;
        // Mostrar el modal
        $this->dispatch('openModal');
    }
    
    public function actualizar()
    {
        //si el estudianteId es cero, entonces crear un nuevo estudiante
        if ($this->estudianteId == 0 || $this->estudianteId == null) {
            $estudiante = new Estudiante();
            $estudiante->nombres = $this->nombre;
            $estudiante->direccion = $this->direccion;
            $estudiante->edad = $this->edad;
            $estudiante->save();
            // Cerrar el modal después de crear
            $this->dispatch('cerrarModal');
        }else{
             // Actualizar el estudiante
            $estudiante = Estudiante::find($this->estudianteId);
            $estudiante->nombres = $this->nombre;
            $estudiante->direccion = $this->direccion;
            $estudiante->edad = $this->edad;
            $estudiante->save();
            // Cerrar el modal después de actualizar
            $this->dispatch('cerrarModal');
        }
       
    }
    //openModal para crear
    public function openModal()
    {
        $this->nombre = '';
        $this->direccion = '';
        $this->edad = '';
        $this->estudianteId = 0;
        //color el estudianteId como cero
        $this->dispatch('openModal');
    }
    //eliminar
    public function eliminar($estudianteId)
    {
        $estudiante = Estudiante::find($estudianteId);
        $estudiante->delete();
    }
}
