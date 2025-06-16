<!-- Standards Hierarchical View -->
<div class="report-section">
    <!-- المعيار الرئيسي -->
    <div class="standard-block">
        <table class="standard-table" width="100%">
            <tr>
                <td width="5%" class="sequence-main">{{ $standard->sequence }}</td>
                <td width="95%"><strong>{{ $standard->name }}</strong></td>
            </tr>
        </table>
        <div class="text-block">
            {!! $standard->introduction !!}
            {!! $standard->description !!}
        </div>

        <!-- المعايير الفرعية -->
        <div class="sub-standards-block">
            @foreach ($standard->children as $child)
                <div class="sub-standard-item">
                    <table class="standard-table" width="100%">
                        <tr>
                            <td width="5%" class="sequence-sub">{{ $child->sequence }}</td>
                            <td width="95%"><strong>{{ $child->name }}</strong></td>
                        </tr>
                    </table>
                    <div class="text-block">
                        {!! $child->introduction !!}
                        {!! $child->description !!}
                    </div>

                    <!-- المحكات -->
                    <div class="criteria-block">
                        @foreach ($child->criteria as $criterion)
                            <div class="criterion-item">
                                <table class="standard-table" width="100%">
                                    <tr>
                                        <td width="5%" class="sequence-criterion">{{ $criterion->sequence }}</td>
                                        <td width="95%">{{ $criterion->name }}</td>
                                    </tr>
                                </table>
                                <div class="text-block">
                                    {!! $criterion->content !!}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($child->summary)
                        <div class="summary-block">
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

<style>
/* تنسيقات عامة للطباعة */
.report-section {
    font-family: 'Traditional Arabic', Arial, sans-serif;
    line-height: 1.6;
    margin: 20px 0;
}

/* تنسيق الجداول */
.standard-table {
    border-collapse: collapse;
    margin-bottom: 10px;
    width: 100%;
}

.standard-table td {
    padding: 3px;
    vertical-align: top;
}

/* تنسيق التسلسلات */
.sequence-main {
    color: #000;
    font-size: 16pt;
    font-weight: bold;
    padding-left: 0;
}

.sequence-sub {
    color: #000;
    font-size: 14pt;
    font-weight: bold;
    padding-left: 0;
    padding-right: 15px;
}

.sequence-criterion {
    color: #000;
    font-size: 12pt;
    padding-left: 0;
    padding-right: 25px;
}

/* تنسيق النصوص */
.text-block {
    margin: 10px 0;
    padding-right: 10px;
    text-align: justify;
}

/* تنسيق المستويات */
.sub-standards-block {
    margin-right: 20px;
}

.sub-standard-item {
    margin: 15px 0;
}

.criteria-block {
    margin-right: 20px;
}

.criterion-item {
    margin: 10px 0;
}

/* تنسيق الملخصات */
.summary-block {
    margin: 10px 0;
    padding: 10px 0;
    border-top: 1px solid #000;
}

.main-summary {
    margin-top: 20px;
}

/* تنسيقات خاصة للطباعة */
@media print {
    .report-section {
        page-break-inside: avoid;
    }

    .sub-standard-item {
        page-break-inside: avoid;
    }

    .criterion-item {
<!-- Standards Hierarchical View -->
<div class="report-section">
    <!-- المعيار الرئيسي -->
    <div class="standard-block">
        <table class="standard-table" width="100%">
            <tr>
                <td width="10%" class="sequence-main">{{ $standard->sequence }}</td>
                <td width="90%"><strong>{{ $standard->name }}</strong></td>
            </tr>
        </table>
        <div class="text-block">
            {!! $standard->introduction !!}
            {!! $standard->description !!}
        </div>

        <!-- المعايير الفرعية -->
        <div class="sub-standards-block">
            @foreach ($standard->children as $child)
                <div class="sub-standard-item">
                    <table class="standard-table" width="100%">
                        <tr>
                            <td width="10%" class="sequence-sub">{{ $child->sequence }}</td>
                            <td width="90%"><strong>{{ $child->name }}</strong></td>
                        </tr>
                    </table>
                    <div class="text-block">
                        {!! $child->introduction !!}
                        {!! $child->description !!}
                    </div>

                    <!-- المحكات -->
                    <div class="criteria-block">
                        @foreach ($child->criteria as $criterion)
                            <div class="criterion-item">
                                <table class="standard-table" width="100%">
                                    <tr>
                                        <td width="10%" class="sequence-criterion">{{ $criterion->sequence }}</td>
                                        <td width="90%">{{ $criterion->name }}</td>
                                    </tr>
                                </table>
                                <div class="text-block">
                                    {!! $criterion->content !!}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($child->summary)
                        <div class="summary-block">
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

<style>
/* تنسيقات عامة للطباعة */
.report-section {
    font-family: 'Traditional Arabic', Arial, sans-serif;
    line-height: 1.6;
    margin: 20px 0;
}

/* تنسيق الجداول */
.standard-table {
    border-collapse: collapse;
    margin-bottom: 10px;
}

/* تنسيق التسلسلات */
.sequence-main {
    color: #000;
    font-size: 16pt;
    font-weight: bold;
    padding: 5px;
}

.sequence-sub {
    color: #000;
    font-size: 14pt;
    font-weight: bold;
    padding: 5px;
    padding-right: 25px;
}

.sequence-criterion {
    color: #000;
    font-size: 12pt;
    padding: 5px;
    padding-right: 45px;
}

/* تنسيق النصوص */
.text-block {
    margin: 10px 0;
    padding-right: 10px;
    text-align: justify;
}

/* تنسيق المستويات */
.sub-standards-block {
    margin-right: 20px;
}

.sub-standard-item {
    margin: 15px 0;
}

.criteria-block {
    margin-right: 20px;
}

.criterion-item {
    margin: 10px 0;
}

/* تنسيق الملخصات */
.summary-block {
    margin: 10px 0;
    padding: 10px 0;
    border-top: 1px solid #000;
}

.main-summary {
    margin-top: 20px;
}

/* تنسيقات خاصة للطباعة */
@media print {
    .report-section {
        page-break-inside: avoid;
    }

    .sub-standard-item {
        page-break-inside: avoid;
    }

    .criterion-item {
        page-break-inside: avoid;
    }
}
</style>