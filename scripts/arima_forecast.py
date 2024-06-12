import pandas as pd
import sys
import json
from statsmodels.tsa.arima.model import ARIMA

def arima_forecast(data):
    # Konversi data ke DataFrame
    df = pd.DataFrame(data)
    df['tanggal'] = pd.to_datetime(df['tanggal'])
    df.set_index('tanggal', inplace=True)

    # Tambahkan frekuensi
    df = df.asfreq('D')  # Anda bisa menyesuaikan 'D' menjadi 'M' atau 'MS' sesuai kebutuhan

    # Model ARIMA dengan p=1, d=1, q=1
    model = ARIMA(df['total'], order=(1, 1, 1))
    model_fit = model.fit()

    # Prediksi satu bulan ke depan
    forecast = model_fit.forecast(steps=1)
    return forecast[0]

if __name__ == "__main__":
    try:
        with open(sys.argv[1], 'r') as f:
            data = json.load(f)
        prediction = arima_forecast(data)
        print(prediction)
    except Exception as e:
        print(f"Error: {e}", file=sys.stderr)
        sys.exit(1)
