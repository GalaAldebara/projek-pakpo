document.addEventListener('DOMContentLoaded', () => {
    const kreditCheckbox = document.getElementById('is_kredit');
    const hariWrapper = document.getElementById('hari_kredit_wrapper');
    let rowIndex = 1;

    const toggleBarangInputs = (enabled) => {
        const elements = document.querySelectorAll('#barangTableBody input, #barangTableBody select, #addRow');
        elements.forEach(el => {
            el.disabled = !enabled;
            if (!enabled) {
                el.classList.add('bg-gray-100', 'cursor-not-allowed', 'opacity-50');
                el.classList.remove('hover:border-blue-500', 'focus:border-blue-500');
            } else {
                el.classList.remove('bg-gray-100', 'cursor-not-allowed', 'opacity-50');
                el.classList.add('hover:border-blue-500', 'focus:border-blue-500');
            }
        });
    };
    toggleBarangInputs(false);

    // Toggle Kredit
    kreditCheckbox.addEventListener('change', () => {
        if (kreditCheckbox.checked) {
            hariWrapper.classList.remove('hidden');
            setTimeout(() => {
                hariWrapper.style.opacity = '1';
                hariWrapper.style.transform = 'translateY(0)';
            }, 10);
        } else {
            hariWrapper.style.opacity = '0';
            hariWrapper.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                hariWrapper.classList.add('hidden');
            }, 300);
        }
    });

    // Modal Supplier
    const supplierModal = document.getElementById('supplierModal');
    const btnCariSupplier = document.getElementById('btnCariSupplier');
    const closeSupplierModal = document.getElementById('closeSupplierModal');

    btnCariSupplier.addEventListener('click', () => {
        supplierModal.classList.remove('hidden');
        supplierModal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    });

    closeSupplierModal.addEventListener('click', () => {
        supplierModal.classList.add('hidden');
        supplierModal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    });

    document.querySelectorAll('.pilihSupplier').forEach(btn => {
        btn.addEventListener('click', () => {
            const kode = btn.getAttribute('data-kode');
            const nama = btn.getAttribute('data-nama');
            document.getElementById('kode_supplier').value = kode;
            document.getElementById('nama_supplier').value = nama;
            toggleBarangInputs(true);
            supplierModal.classList.add('hidden');
            supplierModal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        });
    });

    // Item modal & selection logic...
    // (Kode panjang lainnya bisa dipindahkan ke file JS ini)
});
