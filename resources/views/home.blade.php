@extends('layouts.app')
@section('title', 'Главная')
@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded-2xl shadow space-y-4">
        <h1 class="text-2xl font-bold text-gray-800">Контактная информация</h1>

        <div class="text-sm text-gray-700 space-y-2">
            <p>
                📄 <strong>Тестовое задание:</strong>
                <a href="https://docs.google.com/document/d/1AS9WeZz6Ak9eS5u2UtrRUGcJs1TKskcpH7faURtSaZY/edit?tab=t.0" class="text-indigo-600 hover:underline" target="_blank">
                    Клик
                </a>
            </p>

            <p>
                📃 <strong>Резюме:</strong>
                <a href="https://magnitogorsk.hh.ru/resume_converter/%D0%92%D0%B0%D1%81%D1%8E%D0%BA%D0%BE%D0%B2%20%D0%9A%D0%B8%D1%80%D0%B8%D0%BB%D0%BB%20%D0%90%D1%80%D1%82%D0%B5%D0%BC%D0%BE%D0%B2%D0%B8%D1%87.pdf?hash=5ef0a16bff09ed36bc0039ed1f6333576d6235&type=pdf&hhtmFrom=resume_list&hhtmSource=resume" class="text-indigo-600 hover:underline" target="_blank">
                    Скачать резюме (PDF)
                </a>
            </p>

            <p>
                💬 <strong>Telegram:</strong>
                <a href="https://t.me/b3dtrp" class="text-indigo-600 hover:underline" target="_blank">
                    @b3dtrp
                </a>
            </p>

            <p>
                ✉️ <strong>Email:</strong>
                <a href="mailto:kvasyukov99@gmail.com" class="text-indigo-600 hover:underline">
                    kvasyukov99@gmail.com
                </a>
            </p>
        </div>
    </div>
@endsection
