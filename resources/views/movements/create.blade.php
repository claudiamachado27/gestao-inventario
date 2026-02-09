<!-- Modal Adicionar Movimento -->
<div class="modal fade" id="createMovementModal" tabindex="-1" aria-labelledby="createMovementModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-surface border-custom" style="border-radius: 1rem;">
            <div class="modal-header border-bottom border-custom">
                <h1 class="modal-title fs-5 fw-bold" id="createMovementModalLabel">Adicionar Movimento</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 p-md-5">
                <form action="{{ route('movements.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="label-caps d-block">Tipo de Movimento</label>
                        <div class="btn-toggle-group">
                            <input type="radio" class="btn-check" name="tipo" id="receita" value="receita"
                                autocomplete="off">
                            <label class="btn-toggle-item" for="receita">
                                <i class="bi bi-graph-up-arrow"></i> Receita
                            </label>

                            <input type="radio" class="btn-check" name="tipo" id="despesa" value="despesa"
                                autocomplete="off" checked>
                            <label class="btn-toggle-item" for="despesa">
                                <i class="bi bi-graph-down-arrow"></i> Despesa
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="label-caps d-block">Descrição</label>
                        <div class="position-relative">
                            <input type="text" class="form-control" name="descricao" placeholder="Ex: Supermercado"
                                required autocomplete="off">
                            <i
                                class="bi bi-pencil position-absolute top-50 end-0 translate-middle-y pe-3 text-secondary"></i>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="label-caps d-block">Valor</label>
                            <div class="position-relative">
                                <input type="number" step="0.01" class="form-control" name="valor"
                                    placeholder="0,00" required>
                                <i
                                    class="bi bi-currency-euro position-absolute top-50 end-0 translate-middle-y pe-3 text-secondary"></i>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="label-caps d-block">Categoria</label>
                            <select class="form-select" name="categoria_id" required>
                                <option disabled selected value="">Selecione...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="label-caps d-block">Data</label>
                            <input type="date" class="form-control" name="data" style="color-scheme: dark;"
                                required>
                        </div>
                    </div>

                    <div class="d-flex flex-column-reverse flex-sm-row gap-3 pt-3 border-top border-custom">
                        <button type="button" class="btn btn-cancel-custom" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="btn btn-primary-custom ms-sm-auto d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-check2-circle fs-5"></i>
                            Salvar Movimento
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
