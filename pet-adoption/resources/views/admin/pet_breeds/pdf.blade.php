<!DOCTYPE html>
<html>
<head>
    <title>Pet Breeds Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 40px;
            color: #1f2937; /* gray-800 */
            position: relative;
        }

        /* Watermark styling */
        .watermark {
            position: fixed;
            top: 35%;
            left: 15%;
            font-size: 80px;
            color: rgba(13, 148, 136, 0.1); /* teal-600 transparent */
            transform: rotate(-30deg);
            z-index: 0;
            pointer-events: none;
        }

        .report-header {
            text-align: center;
            margin-bottom: 1rem;
            z-index: 1;
            position: relative;
        }

        .report-header h1 {
            font-size: 2rem;
            font-weight: bold;
            color: #0d9488; /* teal-600 */
            margin: 0;
        }

        .subheading {
            color: #6b7280; /* gray-500 */
            font-size: 0.95rem;
            margin-top: 0.25rem;
            margin-bottom: 1.5rem;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 0.95rem;
            z-index: 1;
            position: relative;
        }

        th {
            background-color: #0d9488;
            color: #ffffff;
            padding: 12px;
            text-align: left;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        td {
            background-color: #ffffff;
            padding: 10px;
            border-bottom: 1px solid #e5e7eb; /* gray-200 */
        }

        tr:nth-child(even) td {
            background-color: #f9fafb; /* gray-50 */
        }

        .table-wrapper {
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>
<body>

    <!-- Watermark -->
    <div class="watermark">PetAdoption</div>

    <!-- Header -->
    <div class="report-header">
        <h1>PetAdoption</h1>
        <div class="subheading">Pet Breeds Report</div>
    </div>

    <!-- Table -->
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Breed</th>
                    <th>Pet Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach($breeds as $breed)
                    <tr>
                        <td>{{ $breed->id }}</td>
                        <td>{{ $breed->breed }}</td>
                        <td>{{ $breed->petType->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
