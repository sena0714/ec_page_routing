# ページルーティング
ページルーティングの処理を作成。
「src/Service/Page/Setting」にパスやコントローラーを登録する。
作成済みの例：
  「/cart/カートID」 にアクセスするとindex.phpを通ってShoppingControllerのindexメソッドを呼び出す。
  「/edit/cart/カートID」 にアクセスするとindex.phpを通ってShoppingControllerのeditメソッドを呼び出す。

# ec機能
カートの合計金額を研鑽する機能を作成。
「/cart/カートID」にアクセスすると、「Repository/ProductRepository::findByCartId()」のデータのpriceの合計が税込み価格で計算されて表示される。
