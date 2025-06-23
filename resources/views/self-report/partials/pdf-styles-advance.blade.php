<style>
    /* @import url('https://fonts.googleapis.com/css2?family=Majalla:wght@200..1000&family=Noto+Kufi+Arabic:wght@100..900&display=swap'); */



    /* p {
        color: #666;
        text-align: center;
    } */

    body{
        font-size: 18px;
        font-family: 'ArialCE', sans-serif;
    }
    h1 ,h2 ,h3 ,h4 ,h5 ,h6 {
        color:#4c3d8e;
    }

    img {
        max-width: 100%;
        height: auto;
    }



    table {
        width: 100%;
        border-collapse: collapse !important;
    }

    main {
        page-break-inside: auto !important;
        padding: 10px;
        margin-top: 20px;
    }
    .primarybg {
        background-color: #4c3d8e;
        color: #fff;
        padding: 5px;
    }

    .page-number:before {
        content: counter(page);
    }
    .cover-img {
        width: 100%;
        height: 297mm; /* A4 height */
        object-fit: cover;
        margin: 0;
        padding: 0;
        /* page-break-after: always; */
    }

    .cover-page {
        /* margin: 0;
        padding: 0; */
        height: 297mm;
        width: 210mm;
    }

   /* .footer {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        height: 80px;
    }*/


    .sub-number {
        width: 50px !important;
        /* height: fit-content !important; */

    }

    .number {
        width: 50px !important;
        /* height: fit-content !important; */

    }

    .description {
        display:flex;
        direction: rtl; /* للنصوص العربية */
        /* text-emphasis-position: initial */
        text-align: right;
        padding: 10px;

    }
    .description p {
        display:flex;
        text-align: right;
        /* white-space: pre-wrap;  */


    }
    .text-justify {
        text-align: start;
        font-size: 14pt;
    }
    .tabs * td{
        border: 0.1px rgb(150, 150, 228) solid !important;
        text-align: right !important;
    }

    * td{
        /* border: 0.1px rgb(150, 150, 228) solid !important; */
        /* padding: 3px !important; */
        /* height: fit-content !important; */
        /* clear: both; */
        text-align: right;
        padding: 10px;

    }

    .squen{
        width: 30px;
    }
    @page {
        header: page-header;
        footer: page-footer;
    }

    .standard thead td{

        border: 4px double #393bc7;
        font-size: 20px !important;
        text-align: center !important;
        font-weight: bold !important;
        color: white
    }
   .standard td{
    font-weight: bold !important;

        border: 4px double #393bc7;
        color: white
    }
   .info td{

        border: 1px solid #000000;
        color: rgb(0, 0, 0)
    }
</style>
