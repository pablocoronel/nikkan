@component('mail::message')
# Contacto

## Nombre: 
{{ $mensaje->nombre }}

## Email: 
{{ $mensaje->email }}

## Asunto: 
{{ $mensaje->asunto }}

## Mensaje: 
{{ $mensaje->mensaje }}

@endcomponent
