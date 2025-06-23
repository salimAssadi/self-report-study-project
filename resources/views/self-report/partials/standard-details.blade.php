<!-- Standards Hierarchical View -->
<div class="standards-details-section">
    <!-- المعيار الرئيسي -->
    <div class="standard-block">

        <div class="text-block main-text">
            @if($standard->description)
                {!! $standard->description !!}
            @endif
        </div>

        <!-- المعايير الفرعية -->
        <div class="sub-standards-block">
            @foreach ($standard->children as $child)
                <div class="sub-standard-item">

                    <div class="text-block sub-text">
                        @if($child->description)
                            {!! $child->description !!}
                        @endif
                    </div>

                    <!-- المحكات -->
                    <div class="criteria-block">
                        @foreach ($child->criteria as $criterion)
                            <div class="criterion-item">
                                @if($criterion->content)
                                    <div class="text-block criterion-text">
                                        {!! $criterion->content !!}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    @if($child->summary)
                        <div class="summary-block sub-summary">
                            {!! $child->summary !!}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        @if($standard->summary)
            <div class="summary-block main-summary">
                {!! $standard->summary !!}
            </div>
        @endif
    </div>
</div>

{{-- <style>
/* تنسيقات خاصة بقسم تفاصيل المعايير */
.standards-details-section {
    font-family: 'Almarai', 'Traditional Arabic', Arial, sans-serif;
    margin-top: 5px;
    margin-bottom: 5px;
}

/* تنسيق الجداول */
.standards-details-section .standard-table {
    border-collapse: collapse;
    margin-bottom: 5px;
    width: 100%;
}

.standards-details-section .standard-table td {
    padding: 2px;
    vertical-align: top;
}

/* تنسيق العناوين */
.standards-details-section .title-main {
    font-size: 13px;
    font-weight: bold;
    color: #000000;
}

.standards-details-section .title-sub {
    font-size: 12px;
    font-weight: bold;
    color: #1143e7;
}

.standards-details-section .title-criterion {
    font-size: 11px;
    color: #000000;
}

/* تنسيق التسلسلات */
.standards-details-section .sequence-main {
    font-size: 13px;
    font-weight: bold;
    color: #000000;
}

.standards-details-section .sequence-sub {
    font-size: 12px;
    font-weight: bold;
    color: #1143e7;
}

.standards-details-section .sequence-criterion {
    font-size: 11px;
    color: #000000;
}

/* تنسيق النصوص */
.standards-details-section .text-block {
    margin: 6px 0;
    text-align: justify;
    color: #000000;
}

.standards-details-section .main-text {
    font-size: 11px;
    padding-right: 0;
}

.standards-details-section .sub-text {
    font-size: 11px;
    padding-right: 25px;
    margin-right: 15px;
}

.standards-details-section .criterion-text {
    font-size: 11px;
    padding-right: 35px;
    margin-right: 25px;
}

/* تنسيق المستويات */
.standards-details-section .sub-standards-block {
    margin-top: 15px;
}

.standards-details-section .sub-standard-item {
    margin: 12px 0;
    margin-right: 15px;
    padding-top: 6px;
}

.standards-details-section .criteria-block {
    margin-top: 8px;
}

.standards-details-section .criterion-item {
    margin: 8px 0;
    margin-right: 25px;
    padding-top: 4px;
}

/* تنسيق الملخصات */
.standards-details-section .summary-block {
    margin: 6px 0;
    padding: 6px 0;
    font-size: 11px;
    color: #000000;
}

.standards-details-section .main-summary {
    margin-top: 10px;
    color: #000000;
}

.standards-details-section .sub-summary {
    padding-right: 25px;
    margin-right: 15px;
    color: #000000;
}
</style> --}}
