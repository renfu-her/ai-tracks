# ai-tracks

## 安裝
```
composer install
cp .env.example .env
php artisan key:generate
```

## 修改 DB，以及 APP_URL 然後執行以下命令
```
php artisan migrate
php artisan storage:link
```

## Filament v3 的做法
```
php artisan vendor:publish --force --tag=livewire:assets
php artisan filament:assets
php artisan filament:cache-components
```

## 網站功能流程

### 🏠 **前台網站**
1. **首頁 (Home)**
   - 動態輪播圖 (Slider) - 支援 RWD (桌面 450px 高度，手機自適應)
   - 精選案例展示 - 顯示案例名稱和副標題
   - 最新消息 - 顯示標題和圖片
   - 服務介紹 - AI 助力程式開發與 UI/UX 設計

2. **案例展示頁面 (Cases)**
   - 案例列表展示 - 包含名稱、副標題和圖片
   - 點擊案例可查看詳細內容 (Modal 彈窗)
   - 支援 Markdown 內容渲染
   - 案例照片輪播展示

3. **最新消息頁面 (News)**
   - 消息列表展示 - 包含標題、圖片和發布日期
   - 點擊消息可查看詳細內容 (Modal 彈窗)
   - 支援 Markdown 內容渲染
   - 分類篩選功能

4. **聯絡我們頁面 (Contact)**
   - 聯絡表單 - 姓名、Email、電話、主旨、訊息
   - 聯絡資訊顯示 - 電話、Email
   - 社群媒體連結

### 🔧 **後台管理系統 (Filament Admin)**
1. **案例管理 (ProjectCase)**
   - 基本資訊：名稱、副標題、網址、內容、狀態
   - 內容編輯：Markdown 編輯器 (最小高度 450px)
   - 案例照片管理：透過關聯管理器管理多張照片
   - 照片處理：自動轉換為 WebP 格式，調整尺寸為 1024x1024

2. **案例照片管理 (CasePhoto)**
   - 獨立管理案例照片
   - 照片排序功能
   - 不顯示在左側導航選單

3. **輪播圖管理 (Slider)**
   - 標題、描述、圖片、連結、排序、狀態
   - 支援首頁輪播展示

4. **最新消息管理 (News)**
   - 標題、內容、圖片、發布日期、狀態
   - 內容編輯：Markdown 編輯器

5. **聯絡訊息管理 (Contact)**
   - 管理前台提交的聯絡表單訊息

### 🎨 **技術特色**
- **響應式設計**：Bootstrap 5 + 自定義 CSS
- **Markdown 支援**：前台內容渲染使用 marked.js + github-markdown-css
- **圖片優化**：自動轉換為 WebP 格式，調整尺寸
- **SEO 優化**：Meta 標籤、Open Graph、Twitter Cards、Sitemap、Robots.txt
- **使用者體驗**：回到頂部按鈕、平滑滾動、載入動畫
- **表單驗證**：前後端雙重驗證
- **AJAX 互動**：動態載入案例和消息詳細內容

### 📱 **響應式設計**
- **桌面版**：完整功能展示，固定高度輪播
- **平板版**：適配中等螢幕尺寸
- **手機版**：自適應高度，觸控友善介面

### 🔍 **SEO 功能**
- Meta 描述和關鍵字
- Open Graph 標籤
- Twitter Cards
- 規範化 URL
- XML Sitemap
- Robots.txt

### 🚀 **部署建議**
1. 設定環境變數
2. 執行資料庫遷移
3. 建立儲存空間連結
4. 清除快取
5. 設定 Web 伺服器