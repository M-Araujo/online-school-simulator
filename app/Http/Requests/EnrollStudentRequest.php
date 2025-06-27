<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class EnrollStudentRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'course_id' => [
                'required',
                'int',
                'exists:courses,id',
                Rule::unique('enrollments')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                }),
            ],
            'enroled_at' => 'nullable|date',
        ];
    }

    public function messages() {
        return [
            'course_id.unique' => 'You are already enrolled in this course.',
        ];
    }
}
