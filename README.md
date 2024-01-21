このアプリケーションを使用可能にするまでの手順

1. composer install

2. Key gen

3. Npm install

4. Storage/app/publicにproductsフォルダとshopsフォルダを作成後、それぞれにpublic/image内の画像ファイルをコピー・ペースト

決済処理を利用する場合は、stripeから公開鍵と非公開鍵を.envの定数
STRIPE_PUBLIC_KEY
STRIPE_SECRET_KEY
に設定してください。

購入完了メールを利用する場合はmailtrapの必要情報を.envに設定してください。

※DB接続不可の場合volumeの削除と再build
