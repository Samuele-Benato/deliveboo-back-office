@extends('layouts.app')

@section('content')
    <div class="food_container">
        <div class="container mt-2">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Modifica piatto :</h1>
                <div class="btn btn-primary ms-auto">
                    <a class="text-white text-decoration-none " href="{{ route('admin.plates.index') }}">⬅️ Torna al menù
                    </a>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="my-3 required-fields">* Questi campi sono obbligatori</div>

            <form action="{{ route('admin.plates.update', $plate) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row gap-4">
                    <div class="col-12 my-2">
                        <label for="name" class="form-label fw-bold">Nome piatto*:</label>
                        <input type="text" id="name" name="name"
                            class="form-control  @error('name') is-invalid @enderror" placeholder="Nome del piatto"
                            value="{{ old('name') ?? $plate->name }}">
                        {{-- @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror --}}
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <label for="image" class="form-label fw-bold">URL dell'immagine:</label>
                            <input type="file" name="image" id="image"
                                class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}">

                            {{-- @error('image')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror --}}
                        </div>
                        <div class="col-4 mt-2">
                            <img src="{{ asset('/storage/' . $plate->image) }}" class="img-fluid" id="image_preview">
                        </div>
                        <!--
                            <div class="mt-2 required-fields">L'immagine è stata
                                    aggiornata. Si
                                    prega di reinserirne una.(?)</div>
                         -->
                    </div>


                    <div class="col-12 my-2">
                        <label for="price" class="form-label fw-bold">Prezzo*:</label>
                        <input type="number" min="0" max="100" step="0.01" id="price" name="price"
                            class="form-control @error('price') is-invalid @enderror" placeholder="Prezzo el piatto"
                            value="{{ old('price') ?? $plate->price }}">
                        {{-- @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror --}}
                    </div>

                    {{-- <div class="col-6 my-2">
                            <label for="type_id" class="form-label"><strong>Tipo</strong></label>
                            <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror">
                                <option value="">Seleziona il tipo</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" @if (old('type_id') == $type->id) selected @endif>
                                        {{ $type->label }}
                                    </option>
                                @endforeach
                            </select> --}}
                    {{-- @error('type_id')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror --}}
                    {{-- </div> --}}

                    <div class="col-12">
                        <label for="ingredients" class="form-label fw-bold">Ingredienti*:</label>
                        <input type="textarea" id="ingredients" name="ingredients"
                            class="form-control @error('ingredients') is-invalid @enderror"
                            placeholder="Ingredienti del piatto" value="{{ old('ingredients') ?? $plate->ingredients }}">
                        {{-- @error('ingredients')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror --}}
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label fw-bold">Descrizione</label>
                        <textarea class="form-control" id="description" name="description" rows="2">{{ old('description') ?? $plate->description }}
                                </textarea>
                        {{-- @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror --}}
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-success w-25 my-5 fw-bold">Salva</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        const inputFileElement = document.getElementById('image');
        const imagePreview = document.getElementById('image_preview');
        //const updateMessage = document.getElementById('updateMessage');

        if (!imagePreview.getAttribute('src') || imagePreview.getAttribute('src') ==
            "http://localhost:8000/storage") {
            imagePreview.src = "https://placehold.co/400";
        }

        /*  function updateImagePreview() {
                    if (inputFileElement.value) {
                        const [file] = inputFileElement.files;
                        imagePreview.src = URL.createObjectURL(file);
                        imagePreview.classList.add('d-block'); // Mostra l'anteprima
                        updateMessage.classList.add('d-none'); // Mostra il messaggio di avviso
                    } else {
                        updateMessage.classList.remove('d-none'); // Nascondi il messaggio se l'input è vuoto
                    }
                }

                inputFileElement.addEventListener('change', updateImagePreview);
                window.addEventListener('DOMContentLoaded', updateImagePreview);
        */
        inputFileElement.addEventListener('change', function() {
            const [file] = this.files;
            imagePreview.src = URL.createObjectURL(file);
        })
    </script>
@endsection
