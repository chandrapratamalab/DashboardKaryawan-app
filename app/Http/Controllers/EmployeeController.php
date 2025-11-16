<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('admin.employees'); // Langsung ke admin/employe.blade.php
    }

    public function create()
    {
        return view('admin.employe-create');
    }

    public function store(Request $request)
    {
        // Logic untuk menyimpan data karyawan
        return redirect()->route('employees.index');
    }

    public function show($id)
    {
        return view('admin.employe-show', compact('id'));
    }

    public function edit($id)
    {
        return view('admin.employe-edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logic untuk update data karyawan
        return redirect()->route('employees.index');
    }

    public function destroy($id)
    {
        // Logic untuk hapus data karyawan
        return redirect()->route('employees.index');
    }
}