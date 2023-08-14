document.addEventListener('DOMContentLoaded', function () {
    const pdfIframe = document.getElementById('pdf-iframe');
    const bookmarkButton = document.getElementById('bookmarked');
    const bookIdInput = document.getElementById('bookId');
    const bookId = bookIdInput.value;

    bookmarkButton.addEventListener('click', function () {
        const currentPage = getCurrentPageNumber();
        savePageNumber(bookId, currentPage);
    });

    pdfIframe.onload = function () {
        attachIframeListeners();
        restoreLastPage(bookId);
    };

    function attachIframeListeners() {
        // Attach any necessary event listeners here
    }

    function getCurrentPageNumber() {
        const iframeDoc = pdfIframe.contentWindow.document;
        const pageNumElement = iframeDoc.querySelector('.page[data-page-number]') || iframeDoc.querySelector('.pdfViewer');

        if (pageNumElement) {
            const currentPage = parseInt(pageNumElement.getAttribute('data-page-number'));
            console.log('Current Page:', currentPage);
            return currentPage;
        } else {
            console.log('No page number found');
            return null;
        }
    }

    function savePageNumber(bookId, page) {
        const key = `pdf["book--${bookId}"]`;
        const pageNumbers = JSON.parse(localStorage.getItem(key)) || {};
        pageNumbers[pdfIframe.src] = page;
        localStorage.setItem(key, JSON.stringify(pageNumbers));
    }

    function restoreLastPage(bookId) {
        const lastPage = getPageNumber(bookId) || 1; // Default to page 1
        displayPage(lastPage);
    }

    function getPageNumber(bookId) {
        const key = `pdf["book--${bookId}"]`;
        const pageNumbers = JSON.parse(localStorage.getItem(key)) || {};
        return pageNumbers[pdfIframe.src] || null;
    }

    function displayPage(pageNumber) {
        const iframeDoc = pdfIframe.contentWindow.document;
        const pageInput = iframeDoc.querySelector('.toolbar.page .pageNumber');

        if (pageInput) {
            pageInput.value = pageNumber;
            pageInput.dispatchEvent(new Event('change'));
        }
    }
});
