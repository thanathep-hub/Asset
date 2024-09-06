<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คำนวณค่าเสื่อมราคาแบบอัตราเร่ง</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">

    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">คำนวณค่าเสื่อมราคาแบบอัตราเร่ง</h1>

        <form id="depreciationForm" class="space-y-4">
            <div>
                <label for="initialPrice" class="block text-sm font-medium text-gray-700">ราคาทุน (Initial
                    Price):</label>
                <input type="number" id="initialPrice" name="initialPrice" value="6450"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div>
                <label for="depreciationRate" class="block text-sm font-medium text-gray-700">อัตราการเสื่อมราคา
                    (%)</label>
                <input type="number" id="depreciationRate" name="depreciationRate" value="20"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div>
                <label for="usefulLife" class="block text-sm font-medium text-gray-700">อายุการใช้งาน (ปี):</label>
                <input type="number" id="usefulLife" name="usefulLife" value="5"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div>
                <label for="daysUsed" class="block text-sm font-medium text-gray-700">จำนวนวันที่ใช้งาน:</label>
                <input type="number" id="daysUsed" name="daysUsed" value="556"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 focus:outline-none">คำนวณ</button>
        </form>

        <div id="result" class="mt-6 bg-gray-50 p-4 rounded-md shadow-sm"></div>
    </div>

    <script>
        document.getElementById('depreciationForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // รับค่าจากฟอร์ม
            let initialPrice = parseFloat(document.getElementById('initialPrice').value);
            let depreciationRate = parseFloat(document.getElementById('depreciationRate').value) / 100;
            let usefulLife = parseInt(document.getElementById('usefulLife').value);
            let daysUsed = parseInt(document.getElementById('daysUsed').value);

            // ฟังก์ชันคำนวณค่าเสื่อมราคา
            function calculateDecliningBalanceDepreciation(initialPrice, depreciationRate, usefulLife, daysUsed) {
                let currentValue = initialPrice;
                let daysInYear = 365;
                let resultHTML = '';
                let totalDepreciation = 0;
                let daysPassed = 0;

                for (let year = 1; year <= usefulLife; year++) {
                    let depreciation = currentValue * depreciationRate; // ค่าเสื่อมราคา
                    resultHTML += `<p>ปีที่ ${year}</p>`;
                    resultHTML += `<p>ราคา: ${currentValue.toFixed(2)} บาท</p>`;
                    currentValue -= depreciation; // ราคาสุทธิหลังหักค่าเสื่อมราคา
                    resultHTML += `<p>ค่าเสื่อม: ${depreciation.toFixed(2)} บาท</p>`;
                    resultHTML += `<p>ราคาสุทธิ: ${currentValue.toFixed(2)} บาท</p>`;
                    resultHTML += '<hr class="my-2">';

                    daysPassed += daysInYear;

                    if (daysUsed <= daysPassed) {
                        let remainingDays = daysUsed - (daysPassed - daysInYear);
                        let proportion = remainingDays / daysInYear;
                        let depreciationForDaysUsed = (initialPrice - totalDepreciation) * depreciationRate *
                            proportion;
                        let adjustedCurrentValue = initialPrice;
                        for (let i = 1; i < year; i++) {
                            adjustedCurrentValue -= adjustedCurrentValue * depreciationRate;
                        }
                        adjustedCurrentValue -= depreciationForDaysUsed;

                        resultHTML += `<p>วันที่ใช้งานในปีที่ ${year}: ${remainingDays} วัน</p>`;
                        resultHTML += `<p>ค่าเสื่อมตามวันที่ใช้งาน: ${depreciationForDaysUsed.toFixed(2)} บาท</p>`;
                        resultHTML +=
                            `<p>ราคาสุทธิหลังจากใช้งาน ${daysUsed} วัน: ${adjustedCurrentValue.toFixed(2)} บาท</p>`;
                        resultHTML += '<hr class="my-4">';
                        break;
                    }

                    totalDepreciation += depreciation; // รวมค่าเสื่อมสะสม
                }
                return resultHTML;
            }

            // เรียกใช้ฟังก์ชันคำนวณ
            let result = calculateDecliningBalanceDepreciation(initialPrice, depreciationRate, usefulLife,
            daysUsed);
            document.getElementById('result').innerHTML = result;
        });
    </script>
</body>

</html>
