<!-- Modal Apagar Movimento -->
<div class="modal fade" id="deleteMovementModal" tabindex="-1" aria-labelledby="deleteMovementModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-surface border-custom" style="border-radius: 1.5rem; overflow: hidden;">
            <div class="modal-body p-0">
                <!-- Cabeçalho idêntico à imagem -->
                <div class="p-4 p-md-5 pb-4 text-center">
                    <div class="icon-box-danger mb-4 mx-auto"
                        style="width: 80px; height: 80px; background: rgba(220, 53, 69, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-exclamation-triangle text-danger" style="font-size: 2.5rem;"></i>
                    </div>
                    <h2 class="display-6 fw-bold mb-2" style="font-size: 1.75rem;">Apagar Movimento</h2>
                    <p class="mb-0" style="color: #88a090; font-size: 0.95rem;">
                        Tem certeza? Esta ação não pode ser desfeita
                    </p>
                </div>

                <div class="px-4 px-md-5 pb-5">
                    <!-- Seção de Seleção -->
                    <div class="mb-4">
                        <label class="label-caps d-block mb-3"
                            style="color: #88a090; letter-spacing: 0.05em; font-weight: 700; font-size: 0.75rem;">SELECIONE
                            O MOVIMENTO</label>
                        <div class="position-relative">
                            <div class="position-relative">
                                <input type="text" class="form-control" id="ajaxSearchInput"
                                    placeholder="Pesquisar movimento..." autocomplete="off"
                                    style="background-color: #ffffff; border: 1px solid var(--custom-border); border-radius: 12px; padding: 15px 20px; color: var(--white);">
                                <i
                                    class="bi bi-search position-absolute top-50 end-0 translate-middle-y pe-4 text-muted"></i>
                            </div>

                            <!-- Lista de Resultados Dinâmica -->
                            <div id="ajaxResults" class="search-results-container shadow d-none"
                                style="position: absolute; top: 100%; left: 0; right: 0; background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; z-index: 1000; max-height: 200px; overflow-y: auto; margin-top: 8px;">
                                <!-- Resultados aparecerão aqui via JS -->
                            </div>
                        </div>
                    </div>

                    <!-- Card de Detalhes -->
                    <div id="ajaxDetailsCard" class="details-box p-4 d-none"
                        style="background-color: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.05); border-radius: 16px;">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="fw-bold text-uppercase"
                                style="font-size: 0.75rem; color: #88a090; letter-spacing: 0.05em;">DETALHES</span>
                            <span id="ajax_detail_type"
                                class="badge rounded-pill d-flex align-items-center gap-2 px-3 py-2"
                                style="font-size: 0.7rem; font-weight: 700;">
                                <i class="bi bi-circle-fill" style="font-size: 0.4rem;"></i> <span
                                    id="ajax_detail_type_text"></span>
                            </span>
                        </div>

                        <div class="stack gap-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span style="color: #6c757d; font-size: 0.9rem;">Descrição</span>
                                <span id="ajax_detail_desc" class="fw-bold"></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span style="color: #6c757d; font-size: 0.9rem;">Categoria</span>
                                <span id="ajax_detail_cat" class="d-flex align-items-center gap-2"></span>
                            </div>
                            <div
                                class="d-flex justify-content-between align-items-center pb-3 border-bottom border-white border-opacity-10">
                                <span style="color: #6c757d; font-size: 0.9rem;">Data</span>
                                <span id="ajax_detail_date"></span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-2">
                                <span class="fw-bold">Valor Total</span>
                                <span id="ajax_detail_val" class="fw-bold" style="font-size: 1.4rem;"></span>
                            </div>
                        </div>

                        <!-- Botões de Ação dentro do Card -->
                        <div class="d-flex gap-3 mt-5">
                            <button type="button" class="btn w-100 py-3 fw-bold" data-bs-dismiss="modal"
                                style="background: #f1f5f9; color: var(--white); border-radius: 12px; border: 1px solid var(--custom-border);">Cancelar</button>
                            <form id="ajaxDeleteForm" action="#" method="POST" class="w-100">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn btn-danger-custom w-100 py-3 fw-bold d-flex align-items-center justify-content-center gap-2"
                                    style="border-radius: 12px;">
                                    <i class="bi bi-trash3"></i> Apagar
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Botão cancelar secundário (quando nada está selecionado) -->
                    <div id="ajax_cancel_empty" class="d-flex justify-content-center mt-4">
                        <button type="button" class="btn py-3 px-5 fw-bold" data-bs-dismiss="modal"
                            style="background: #f1f5f9; color: var(--white); border-radius: 12px; border: 1px solid var(--custom-border);">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('ajaxSearchInput');
        const resultsContainer = document.getElementById('ajaxResults');
        const detailsCard = document.getElementById('ajaxDetailsCard');
        const cancelButtonEmpty = document.getElementById('ajax_cancel_empty');
        const deleteForm = document.getElementById('ajaxDeleteForm');

        // Lógica de Pesquisa AJAX (Database)
        let timeout = null;
        searchInput.addEventListener('input', function() {
            clearTimeout(timeout);
            const query = this.value;

            if (query.length < 1) {
                resultsContainer.classList.add('d-none');
                return;
            }

            timeout = setTimeout(() => {
                fetch(`/movements/apagar?search=${encodeURIComponent(query)}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        resultsContainer.innerHTML = '';
                        if (data.movements.length > 0) {
                            data.movements.forEach(m => {
                                const item = document.createElement('div');
                                item.className = 'search-item';
                                item.style =
                                    'padding: 12px 20px; cursor: pointer; border-bottom: 1px solid rgba(255,255,255,0.05); transition: background 0.2s;';
                                const valorFmt = new Intl.NumberFormat('pt-PT', {
                                    minimumFractionDigits: 2
                                }).format(m.valor);
                                const colorClass = m.tipo === 'despesa' ?
                                    'text-danger' : 'text-success';

                                item.innerHTML = `
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="small fw-medium">${m.descricao}</span>
                                    <span class="${colorClass} small fw-bold">R$ ${valorFmt}</span>
                                </div>
                            `;

                                item.onmouseover = () => item.style
                                    .backgroundColor = 'rgba(255,255,255,0.05)';
                                item.onmouseout = () => item.style.backgroundColor =
                                    'transparent';
                                item.onclick = () => selectMovement(m.id);
                                resultsContainer.appendChild(item);
                            });
                            resultsContainer.classList.remove('d-none');
                        } else {
                            resultsContainer.innerHTML =
                                '<div class="p-3 text-muted small">Nenhum resultado encontrado</div>';
                            resultsContainer.classList.remove('d-none');
                        }
                    })
                    .catch(err => console.error('Erro na pesquisa:', err));
            }, 300);
        });

        // Lógica de Seleção sem Refresh
        function selectMovement(id) {
            fetch(`/movements/apagar?id=${id}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    const m = data.selectedMovement;
                    if (m) {
                        resultsContainer.classList.add('d-none');
                        detailsCard.classList.remove('d-none');
                        cancelButtonEmpty.classList.add('d-none');

                        // Preencher Detalhes
                        document.getElementById('ajax_detail_desc').textContent = m.descricao;

                        // Formatar Data
                        const dateObj = new Date(m.data);
                        document.getElementById('ajax_detail_date').textContent = dateObj
                            .toLocaleDateString('pt-PT');

                        const valorFmt = new Intl.NumberFormat('pt-PT', {
                            minimumFractionDigits: 2
                        }).format(m.valor);
                        const valEl = document.getElementById('ajax_detail_val');
                        valEl.textContent = (m.tipo === 'despesa' ? '-' : '+') + ' R$ ' + valorFmt;
                        valEl.className = 'fw-bold ' + (m.tipo === 'despesa' ? 'text-danger' :
                            'text-success');

                        const typeBadge = document.getElementById('ajax_detail_type');
                        const isDespesa = m.tipo === 'despesa';
                        typeBadge.style.background = isDespesa ? 'rgba(220, 53, 69, 0.1)' :
                            'rgba(16, 185, 129, 0.1)';
                        typeBadge.style.color = isDespesa ? '#ff4d5e' : 'var(--success)';
                        document.getElementById('ajax_detail_type_text').textContent = m.tipo.toUpperCase();

                        const catEl = document.getElementById('ajax_detail_cat');
                        const icon = m.category && m.category.icon ?
                            `<i class="bi ${m.category.icon}"></i>` : '';
                        catEl.innerHTML = `${icon} ${m.category ? m.category.nome : 'Sem Categoria'}`;

                        // Atualizar formulário de apagar
                        deleteForm.action = `/movements/${m.id}`;

                        // Colocar o nome no input de busca para feedback
                        searchInput.value = m.descricao;
                    }
                })
                .catch(err => console.error('Erro ao selecionar:', err));
        }

        // Fechar lista ao clicar fora
        document.addEventListener('click', (e) => {
            if (!searchInput.contains(e.target) && !resultsContainer.contains(e.target)) {
                resultsContainer.classList.add('d-none');
            }
        });
    });
</script>
