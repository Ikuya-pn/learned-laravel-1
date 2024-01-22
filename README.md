このアプリケーションを使用可能にするまでの手順

1. composer install

2. php artisan key:generate

3. npm install, npm run dev

4. php artisan storage:link

5. storage/app/public 内に productsフォルダと shopsフォルダを作成後、それぞれに public/image 内の画像ファイルをコピー・ペースト

決済処理を利用する場合は、stripeから公開鍵と非公開鍵を.envの定数
STRIPE_PUBLIC_KEY
STRIPE_SECRET_KEY
に設定してください。

購入完了メールを利用する場合はmailtrapの必要情報を.envに設定してください。

※DB接続不可の場合はvolumeの削除と再buildを実施してください。
