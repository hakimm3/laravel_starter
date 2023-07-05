<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class UsersImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        Artisan::call('cache:clear');

        $department = \App\Models\Department::where('code', $row['department_code'])->first();
        $user = User::create([
            'name' => $row['name'],
            'username' => $row['username'],
            'email' => $row['email'],
            'department_id' => $department->id,
        ]);
        $user->assignRole($row['role']);
        return $user;
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function rules(): array
    {
        return [
            'department_code' => 'required|exists:departments,code',
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'role' => 'required',
        ];
    }
}
