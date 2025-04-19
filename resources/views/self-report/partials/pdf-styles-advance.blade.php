<style>
    /* @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Noto+Kufi+Arabic:wght@100..900&display=swap'); */
   
   

    /* p {
        color: #666;
        text-align: center;
    } */
  

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
    }

    .page-number:before {
        content: counter(page);
    }
    .cover-img {
            width: 100%;
            height: 100vh;
            object-fit: cover;
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

    #forms-table * td{
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

    /* header td{
        
        border: 4px double #393bc7;
    } */
</style>
