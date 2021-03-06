export default {
    "en": {
        "request": {
            "attr": {
                "_title": "タイトル",
                "_category": "申請項目",
                "_sender": "申請者",
                "_approver": "承認担当者",
                "_status": "ステータス",
                "status": {
                    "_open": "承認待ち",
                    "_in_progress": "承認中",
                    "_approved": "承認済み",
                    "_rejected": "却下"
                },
                "_all_approval": "全員承認",
                "_approval_comment": "承認欄",
                "approval_comment": {
                    "_yes": "あり",
                    "_no": "なし"
                },
                "_memo": "メモ"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜申請管理・申請一覧",
                "_page_title": "申請一覧",
                "search_box": {
                    "_status_df": "すべてのステータス"
                },
                "data_table": {
                    "_request_at": "申請日時",
                    "_last_approved_at": "最終承認日時",
                    "actions": {
                        "_act_show_details": "詳細を確認する",
                        "_act_approve": "承認する",
                        "_act_reject": "却下する"
                    }
                },
                "messages": {
                    "_approve_success": "申請承認が成功しました。",
                    "_approve_failed": "申請承認に失敗しました。",
                    "_reject_success": "申請ステータスの更新が成功しました。",
                    "_reject_failed": "申請ステータスの更新に失敗しました。"
                },
                "others": {
                    "_no_data": "申請データが存在しません。",
                    "_no_search_result": "該当する申請データが存在しません。"
                }
            },
            "info": {
                "_og_title": "友伸會ポータル管理画面｜申請管理・申請詳細情報",
                "_page_title": "申請詳細情報",
                "basic_info": {
                    "_subtitle": "基本情報",
                    "_approval_comment_pl": "例）精算額など"
                },
                "form": {
                    "_subtitle": "申請情報"
                },
                "reply_form": {
                    "_comment_pl": "コメントを入力してください"
                },
                "messages": {
                    "_approve_success": "申請承認が成功しました。",
                    "_approve_failed": "申請承認に失敗しました。",
                    "_reject_success": "申請ステータスの更新が成功しました。",
                    "_reject_failed": "申請ステータスの更新に失敗しました。",
                    "_reply_success": "返信が成功しました。",
                    "_reply_failed": "返信に失敗しました。"
                },
                "others": {
                    "_btn_approve": "承認する",
                    "_btn_reject": "却下する",
                    "_btn_reply": "返信する"
                }
            },
            "template": {
                "list": {
                    "_og_title_": "友伸會ポータル管理画面｜申請管理・申請テンプレート一覧",
                    "_page_title": "申請テンプレート一覧",
                    "data_table": {
                        "_created_at": "作成日時",
                        "actions": {
                            "_act_edit": "編集する",
                            "_act_remove": "削除する"
                        }
                    },
                    "messages": {
                        "_remove_success": "申請テンプレートの削除が成功しました。",
                        "_remove_failed": "申請テンプレートの削除に失敗しました。"
                    },
                    "others": {
                        "_btn_draft_save": "下書きとして保存",
                        "_btn_create": "新規テンプレート作成",
                        "_no_data": "申請テンプレートが存在しません。"
                    }
                },
                "info": {
                    "_og_title_create": "友伸會ポータル管理画面｜申請管理・申請テンプレート編集",
                    "_page_title_create": "新規テンプレート作成",
                    "_page_title_edit": "申請テンプレート編集",
                    "basic_form": {
                        "_subtitle": "基本情報",
                        "_title_pl": "申請テンプレートのタイトルを入力してください",
                        "_approver_pl": "承認担当者のアカウント名を指定してください",
                        "_category_df": "カテゴリーを選択してください",
                        "_memo_pl": "メモを入力してください"
                    },
                    "question_form": {
                        "_subtitle": "申請情報",
                        "_description": "※右側の設問テンプレートから申請項目ゾーンにドラッグ・ドロップし、設問の詳細を定義してください。"
                    },
                    "messages": {
                        "_create_success": "新規申請テンプレートの作成が成功しました。",
                        "_create_failed": "新規申請テンプレートの作成に失敗しました。",
                        "_edit_success": "新規申請テンプレートの編集が成功しました。",
                        "_edit_failed": "新規申請テンプレートの編集に失敗しました。",
                        "_draft_save_success": "申請テンプレートのの下書き保存が成功しました。",
                        "_draft_save_failed": "申請テンプレートのの下書き保存に失敗しました。"
                    },
                    "others": {
                        "_btn_draft_save": "下書きとして保存",
                        "_btn_create": "作成する",
                        "_btn_edit": "編集する",
                        "_no_data": "申請テンプレートが存在しません。"
                    }
                }
            },
            "others": {
                "_modal_no": "キャンセル",
                "_reject_modal_yes": "承認する",
                "_reject_modal_title": "申請を承認",
                "_reject_modal_description": "この申請を承認してもよろしいですか？",
                "_approve_modal_yes": "却下する",
                "_approve_modal_title": "申請を却下",
                "_approve_modal_description": "この申請を却下してもよろしいですか？",
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "申請テンプレートを削除",
                "_remove_modal_description": "このテンプレートを削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "app": {
            "name": "友伸會ポータル管理画面",
            "menu": {
                "top": {
                    "_logout": "ログアウト"
                },
                "sidebar": {
                    "admin_management": {
                        "_main": "管理者アカウント管理",
                        "_admin_list": "管理者一覧",
                        "_role_list": "管理者役割一覧"
                    },
                    "staff_management": {
                        "_main": "スタッフ管理",
                        "_clinic_list": "クリニック一覧",
                        "_staff_list": "スタッフ一覧",
                        "_group_list": "グループ一覧"
                    },
                    "notification_management": {
                        "_main": "お知らせ管理"
                    },
                    "request_management": {
                        "_main": "申請管理",
                        "_request_template_list": "申請テンプレート一覧"
                    },
                    "inquiry_management": {
                        "_main": "問合せ管理"
                    },
                    "page_management": {
                        "_main": "ページ管理"
                    }
                }
            }
        },
        "staff": {
            "attr": {
                "_username": "ユーザー名",
                "_mail_address": "メールアドレス",
                "_position": "職業",
                "positions": {
                    "_dr": "DR",
                    "_dh": "DH",
                    "_others": "その他"
                },
                "_clinic": "クリニック",
                "_user_type": "ユーザータイプ",
                "_memo": "メモ"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜スタッフ管理・スタッフ一覧",
                "_page_title": "スタッフ一覧",
                "search_box": {
                    "_position_df": "すべての職業",
                    "_clinic_df": "すべてのクリニック",
                    "_keyword": "キーワード",
                    "_keyword_pl": "キーワードを入力してください"
                },
                "data_table": {
                    "_registered_at": "登録日時",
                    "_last_login_at": "最終ログイン日時",
                    "actions": {
                        "_act_edit": "スタッフ情報を編集する",
                        "_act_remove": "スタッフ情報を削除する"
                    }
                },
                "messages": {
                    "_remove_success": "スタッフ情報の削除が成功しました。",
                    "_remove_failed": "スタッフ情報の削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規スタッフ登録",
                    "_no_data": "スタッフが存在しません。",
                    "_no_search_result": "該当するスタッフ情報が存在しません。"
                }
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜スタッフ管理・新規スタッフ情報登録",
                "_og_title_edit": "友伸會ポータル管理画面｜スタッフ管理・スタッフ情報編集",
                "_page_title_create": "新規スタッフ情報登録",
                "_page_title_edit": "スタッフ情報編集",
                "form": {
                    "_form_title": "スタッフ情報",
                    "_username_pl": "ユーザー名を入力してください",
                    "_mail_address_pl": "メールアドレスを入力してください",
                    "_position_df": "職業を選択してください",
                    "_clinic_df": "クリニックを指定してください",
                    "user_type_opt": {
                        "_staff_web": "ウェブユーザー",
                        "_staff_mobile": "スマホアプリユーザー"
                    },
                    "_memo_pl": "メモを入力してください"
                },
                "messages": {
                    "_create_success": "新規スタッフの登録が成功しました。",
                    "_create_failed": "新規スタッフの登録に失敗しました。",
                    "_edit_success": "スタッフ情報の編集が成功しました。",
                    "_edit_failed": "スタッフ情報の編集に失敗しました。"
                },
                "others": {
                    "_btn_create": "編集する",
                    "_btn_remove": "削除する"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "スタッフ情報を削除",
                "_remove_modal_description": "このスタッフの情報を削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "passwords": {
            "reset": "パスワードをリセットしました。",
            "sent": "パスワードリマインダーを送信しました。",
            "throttled": "時間を置いて再度お試しください。",
            "token": "このパスワードリセットトークンは無効です。",
            "user": "このメールアドレスに一致するユーザーを見つけることが出来ませんでした。"
        },
        "admin": {
            "attr": {
                "_username": "アカウント名",
                "_mail_address": "メールアドレス",
                "_position": "ポジション",
                "_role": "管理者役割",
                "_memo": "メモ"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜管理者アカウント管理・管理者一覧",
                "_page_title": "管理者一覧",
                "search_box": {
                    "_role_df": "すべての役割"
                },
                "data_table": {
                    "_registered_at": "登録日時",
                    "_last_login_at": "最終ログイン日時",
                    "actions": {
                        "_act_edit": "管理者情報を編集する",
                        "_act_remove": "管理者情報を削除する"
                    }
                },
                "messages": {
                    "_remove_success": "管理者情報の削除が成功しました。",
                    "_remove_failed": "管理者情報の削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規アカウント登録",
                    "_no_data": "管理者アカウントが存在しません。",
                    "_no_search_result": "該当する管理者情報が存在しません。"
                }
            },
            "my_account": {
                "_page_title": "マイアカウント",
                "basic_info": {
                    "_title": "アカウント情報",
                    "_subtitle": "アカウント情報"
                },
                "change_password": {
                    "_title": "パスワード再設定",
                    "_current_pass": "現在のパスワード",
                    "_current_pass_place_holder": "現在のパスワードを入力してください",
                    "_new_pass_place_holder": "新しいパスワードを入力してください",
                    "_verify_pass_place_holder": "確認用パスワードを入力してください",
                    "_new_pass": "新しいパスワード",
                    "_verify_pass": "新しいパスワード",
                    "_password_changed": "管理者情報の編集が成功しました。",
                    "_password_update_failed": "管理者情報の編集に失敗しました。",
                    "_current_pass_not_match": "The current password is not match with old password."
                },
                "_btn_update": "保存"
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜管理者アカウント管理・新規アカウント登録",
                "_og_title_edit": "友伸會ポータル管理画面｜管理者アカウント管理・管理者情報編集",
                "_page_title_create": "新規アカウント登録",
                "_page_title_edit": "管理者情報編集",
                "form": {
                    "_subtitle": "管理者情報",
                    "_username_pl": "アカウント名を入力してください",
                    "_mail_address_pl": "メールアドレスを入力してください",
                    "_position_df": "ポジションを選択してください",
                    "position_opt": {
                        "_bod": "理事長",
                        "_hr": "事務局"
                    },
                    "_memo_pl": "メモを入力してください"
                },
                "messages": {
                    "_create_success": "管理者アカウントの登録が成功しました。",
                    "_create_failed": "管理者アカウントの登録に失敗しました。",
                    "_edit_success": "管理者情報の編集が成功しました。",
                    "_edit_failed": "管理者情報の編集に失敗しました。"
                },
                "others": {
                    "_btn_create": "登録",
                    "_btn_edit": "更新",
                    "_btn_remove": "削除する"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "管理者情報を削除",
                "_remove_modal_description": "この管理者の情報を削除してもよろしいですか？一度削除された情報は復旧することはできません。",
                "_remove_modal_deleted": "仕上げ",
                "_your_item_has_been_deleted": "管理者が削除しました"
            }
        },
        "notification": {
            "attr": {
                "_title": "タイトル",
                "_target_users": "送信対象者",
                "_confirm_required": "承認必須",
                "_content": "本文",
                "_public_at": "公開日時",
                "_status": "ステータス",
                "status": {
                    "_draft": "下書き",
                    "_private": "非公開",
                    "_public": "公開"
                }
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜お知らせ管理・お知らせ一覧",
                "_page_title": "お知らせ一覧",
                "search_box": {
                    "_target_users_df": "すべてのスタッフ",
                    "_public_date": "公開日付",
                    "_status": "公開ステータス",
                    "_status_df": "すべてのステータス"
                },
                "data_table": {
                    "_sent_count": "配送総数",
                    "_read_count": "既読数",
                    "_confirmed_count": "確認済人数",
                    "actions": {
                        "_act_public": "お知らせを公開する",
                        "_act_edit": "編集する",
                        "_act_remove": "削除する",
                        "_act_show_details": "詳細を確認んする",
                        "_act_show_list_user": "送信対象者一覧を確認する"
                    }
                },
                "messages": {
                    "_remove_success": "お知らせ削除が成功しました。",
                    "_remove_failed": "お知らせ削除に失敗しました。",
                    "_stt_update_success": "お知らせステータスの更新が成功しました。",
                    "_stt_update_failed": "お知らせステータスの更新に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規作成",
                    "_no_data": "お知らせデータが存在しません。",
                    "_no_search_result": "該当するお知らせデータが存在しません。"
                }
            },
            "info": {
                "_og_title": "友伸會ポータル管理画面｜お知らせ管理・お知らせ作成",
                "_page_title": "お知らせ作成",
                "_page_title_edit": "お知らせ編集",
                "form": {
                    "_subtitle": "お知らせ情報",
                    "_title_pl": "タイトルを入力してください",
                    "_target_users_des": "※拠点名、職業、及びユーザー名で入力することは可能です。",
                    "target_user_opt": {
                        "_dr": "DR",
                        "_dh": "DH",
                        "_all": "全クリニック",
                        "_manual": "対象者を指定する",
                        "_manual_pl": "送信対象者のユーザー名を入力してください"
                    }
                },
                "messages": {
                    "_create_success": "お知らせ作成が成功しました。",
                    "_create_failed": "お知らせ作成に失敗しました。",
                    "_draft_save_success": "お知らせの下書き保存が成功しました。",
                    "_draft_save_failed": "お知らせの下書き保存に失敗しました。",
                    "_err_content_gt_500": "The length of content less than 500 characters"
                },
                "others": {
                    "_btn_draft_save": "下書きとして保存",
                    "_btn_create": "公開する",
                    "_btn_remove": "削除する"
                }
            },
            "noti_users": {
                "_og_title": "友伸會ポータル管理画面｜お知らせ管理・送信対象者一覧",
                "_page_title": "送信対象者一覧",
                "attr": {
                    "_status": "ステータス",
                    "status": {
                        "_unread": "未読",
                        "_read": "既読",
                        "_unconfirmed": "Unconfirmed",
                        "_confirmed": "Confirmed"
                    }
                },
                "search_box": {
                    "_status_df": "すべてのステータス"
                },
                "data_table": {
                    "_confirmed_at": "確認日時"
                },
                "others": {
                    "_unconfirm": "---",
                    "_no_data": "送信対象者が存在しません。",
                    "_no_search_result": "該当するユーザー情報が存在しません。"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "お知らせを削除",
                "_remove_modal_description": "このお知らせを削除してもよろしいですか？一度削除されたお知らせは復旧することはできません。",
                "require_title": "Title is required",
                "require_group": "Group is required",
                "require_content": "Content is required",
                "schedule_date_lte_now": "Schedule date must be greater than now",
                "_err_schedule_is_empty": "Schedule date is required"
            }
        },
        "role": {
            "attr": {
                "_name": "役割",
                "_permission": "権限"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜管理者アカウント管理・管理者役割一覧",
                "_page_title": "管理者役割一覧",
                "data_table": {
                    "actions": {
                        "_act_edit": "編集する",
                        "_act_remove": "削除する"
                    }
                },
                "messages": {
                    "_remove_success": "管理者役割の削除が成功しました。",
                    "_remove_failed": "管理者役割の削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規役割登録",
                    "_no_data": "管理者役割が存在しません。"
                }
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜管理者アカウント管理・新規役割登録",
                "_og_title_edit": "友伸會ポータル管理画面｜管理者アカウント管理・管理者役割編集",
                "_page_title_create": "新規役割登録",
                "_page_title_edit": "管理者役割編集",
                "form": {
                    "_form_title": "管理者役割情報",
                    "_name_pl": "管理者役割の名前を入力してください",
                    "permission_data": {
                        "_feature_list": "機能一覧",
                        "_all_permission": "すべての権限",
                        "_read": "読み取り",
                        "_create": "作成",
                        "_update": "更新",
                        "_remove": "削除",
                        "features": {
                            "_admin_management": "管理者アカウント管理",
                            "_role_management": "管理者役割管理",
                            "_clinic_management": "クリニック管理",
                            "_group_management": "グループ管理",
                            "_staff_management": "スタッフ管理",
                            "_notification_management": "お知らせ管理",
                            "_request_management": "申請管理",
                            "_request_template_management": "申請テンプレート管理",
                            "_inquiry_management": "問合せ管理",
                            "_page_management": "ページ管理"
                        }
                    }
                },
                "messages": {
                    "_create_success": "管理者役割の登録が成功しました。",
                    "_create_failed": "管理者役割の登録に失敗しました。",
                    "_edit_success": "管理者役割の編集が成功しました。",
                    "_edit_failed": "管理者役割の編集に失敗しました。"
                },
                "others": {
                    "_btn_create": "登録する",
                    "_btn_edit": "編集する",
                    "_btn_remove": "削除する"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "管理者役割を削除",
                "_remove_modal_description": "この管理者役割を削除してもよろしいですか？一度削除された情報は復旧することはできません。",
                "_remove_success": "役割を削除しました"
            }
        },
        "validation": {
            "accepted": "{attribute}を承認してください。",
            "active_url": "{attribute}は、有効なURLではありません。",
            "after": "{attribute}には、{date}以降の日付を指定してください。",
            "after_or_equal": "{attribute}には、{date}以降もしくは同日時を指定してください。",
            "alpha": "{attribute}には、アルファベッドのみ使用できます。",
            "alpha_dash": "{attribute}には、英数字('A-Z','a-z','0-9')とハイフンと下線('-','_')が使用できます。",
            "alpha_num": "{attribute}には、英数字('A-Z','a-z','0-9')が使用できます。",
            "array": "{attribute}には、配列を指定してください。",
            "before": "{attribute}には、{date}以前の日付を指定してください。",
            "before_or_equal": "{attribute}には、{date}以前もしくは同日時を指定してください。",
            "between": {
                "numeric": "{attribute}には、{min}から、{max}までの数字を指定してください。",
                "file": "{attribute}には、{min} KBから{max} KBまでのサイズのファイルを指定してください。",
                "string": "{attribute}は、{min}文字から{max}文字にしてください。",
                "array": "{attribute}の項目は、{min}個から{max}個にしてください。"
            },
            "boolean": "{attribute}には、'true'か'false'を指定してください。",
            "confirmed": "{attribute}と{attribute}確認が一致しません。",
            "date": "{attribute}は、正しい日付ではありません。",
            "date_format": "{attribute}の形式は、'{format}'と合いません。",
            "different": "{attribute}と{other}には、異なるものを指定してください。",
            "digits": "{attribute}は、{digits}桁にしてください。",
            "digits_between": "{attribute}は、{min}桁から{max}桁にしてください。",
            "dimensions": "{attribute}は、正しい縦横比ではありません。",
            "distinct": "{attribute}に重複した値があります。",
            "email": "{attribute}は、有効なメールアドレス形式で指定してください。",
            "exists": "選択された{attribute}は、有効ではありません。",
            "file": "{attribute}はファイルでなければいけません。",
            "filled": "{attribute}は必須です。",
            "image": "{attribute}には、画像を指定してください。",
            "in": "選択された{attribute}は、有効ではありません。",
            "in_array": "{attribute}は、{other}に存在しません。",
            "integer": "{attribute}には、整数を指定してください。",
            "ip": "{attribute}には、有効なIPアドレスを指定してください。",
            "ipv4": "{attribute}はIPv4アドレスを指定してください。",
            "ipv6": "{attribute}はIPv6アドレスを指定してください。",
            "json": "{attribute}には、有効なJSON文字列を指定してください。",
            "max": {
                "numeric": "{attribute}には、{max}以下の数字を指定してください。",
                "file": "{attribute}には、{max} KB以下のファイルを指定してください。",
                "string": "{attribute}は、{max}文字以下にしてください。",
                "array": "{attribute}の項目は、{max}個以下にしてください。"
            },
            "mimes": "{attribute}には、{values}タイプのファイルを指定してください。",
            "mimetypes": "{attribute}には、{values}タイプのファイルを指定してください。",
            "min": {
                "numeric": "{attribute}には、{min}以上の数字を指定してください。",
                "file": "{attribute}には、{min} KB以上のファイルを指定してください。",
                "string": "{attribute}は、{min}文字以上にしてください。",
                "array": "{attribute}の項目は、{max}個以上にしてください。"
            },
            "not_in": "選択された{attribute}は、有効ではありません。",
            "not_regex": "{attribute} は整数で入力してください",
            "numeric": "{attribute}には、数字を指定してください。",
            "present": "{attribute}は、必ず存在しなくてはいけません。",
            "regex": "{attribute}には、有効な正規表現を指定してください。",
            "required": "必ず入力してください。",
            "required_if": "{other}が{value}の場合、{attribute}を指定してください。",
            "required_unless": "{other}が{value}以外の場合、{attribute}を指定してください。",
            "required_with": "{values}が指定されている場合、{attribute}も指定してください。",
            "required_with_all": "{values}が全て指定されている場合、{attribute}も指定してください。",
            "required_without": "{values}が指定されていない場合、{attribute}を指定してください。",
            "required_without_all": "{values}が全て指定されていない場合、{attribute}を指定してください。",
            "same": "{attribute}と{other}が一致しません。",
            "size": {
                "numeric": "{attribute}には、{size}を指定してください。",
                "file": "{attribute}には、{size} KBのファイルを指定してください。",
                "string": "{attribute}は、{size}文字にしてください。",
                "array": "{attribute}の項目は、{size}個にしてください。"
            },
            "string": "{attribute}には、文字を指定してください。",
            "timezone": "{attribute}には、有効なタイムゾーンを指定してください。",
            "unique": "指定の{attribute}は既に使用されています。",
            "uploaded": "{attribute}のアップロードに失敗しました。",
            "url": "{attribute}は、有効なURL形式で指定してください。",
            "custom": {
                "attribute-name": {
                    "rule-name": "custom-message"
                }
            },
            "attributes": []
        },
        "page": {
            "attr": {
                "_type": "Type",
                "_title": "Title",
                "_public": "Public",
                "_public_date": "Public date",
                "_status": "Status",
                "_url": "URL destination",
                "_category": "Category",
                "_image": "Image",
                "_summary": "Summary"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜管理者アカウント管理・管理者一覧",
                "_page_title": "List of articles",
                "search_box": {
                    "_type": "Documents",
                    "_type_pl": "All documents",
                    "_status": "status",
                    "_status_pl": "All status",
                    "_date": "Publication date",
                    "_keyword": "Keyword",
                    "_keyword_pl": "Please enter a keyword",
                    "_btn_clear": "Clear the condition",
                    "_btn_search": "Search by this condition"
                },
                "data_table": {
                    "_title": "書類タイトル",
                    "_type": "種類",
                    "_category": "カテゴリー",
                    "public_date": "公開日付",
                    "status": "ステータス",
                    "_registered_at": "登録日時",
                    "_last_login_at": "最終ログイン日時",
                    "actions": {
                        "_act_edit": "編集する",
                        "_act_remove": "削除する"
                    }
                },
                "messages": {
                    "_remove_success": "管理者情報の削除が成功しました。",
                    "_remove_failed": "管理者情報の削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "Create New",
                    "_no_data": "管理者アカウントが存在しません。",
                    "_no_search_result": "該当する管理者情報が存在しません。"
                }
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜管理者アカウント管理・新規アカウント登録",
                "_og_title_edit": "友伸會ポータル管理画面｜管理者アカウント管理・管理者情報編集",
                "_page_title_create": "Create Page",
                "_page_title_edit": "Edit Page",
                "_basic_info": "Basic information",
                "_article_content": "Article content",
                "tabs": {
                    "_manual": "Manual Setting",
                    "_file": "File Upload"
                },
                "form": {
                    "_title_pl": "Please enter a title",
                    "_url_pl": "Please specify the publication destination",
                    "_category_pl": "Please specify a category",
                    "_title_upload": "Please choose the file",
                    "_content_upload": "Please upload the document (pdf), image file (png, jpg) or video (mp4).",
                    "_btn_upload": "Upload file",
                    "_btn_remove": "Remove Page"
                },
                "messages": {
                    "_create_success": "管理者アカウントの登録が成功しました。",
                    "_create_failed": "管理者アカウントの登録に失敗しました。",
                    "_edit_success": "管理者情報の編集が成功しました。",
                    "_edit_failed": "管理者情報の編集に失敗しました。",
                    "_change_status_success": "Change status success",
                    "_change_status_failed": "Change status failed",
                    "_create_category_success": "Create Category Success",
                    "_create_category_failed": "Create Category Faild"
                },
                "others": {
                    "_btn_create": "登録する",
                    "_btn_edit": "編集する",
                    "_btn_remove": "削除する"
                },
                "popup": {
                    "_create_title": "Create Category",
                    "_btn_create": "Create",
                    "_btn_close": "Close",
                    "_btn_show_popup_category": "Add Category",
                    "attr": {
                        "_name": "Name"
                    }
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "管理者情報を削除",
                "_remove_modal_description": "この管理者の情報を削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "common": [],
        "group": {
            "attr": {
                "_name": "グループ名",
                "_memo": "メモ"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜スタッフ管理・グループ一覧",
                "_page_title": "グループ一覧",
                "data_table": {
                    "_staff_count": "ユーザー数",
                    "actions": {
                        "_act_add_user": "グループユーザーを更新する",
                        "_act_edit": "グループ情報を編集する",
                        "_act_remove": "グループを削除する"
                    }
                },
                "messages": {
                    "_remove_success": "グループ削除が成功しました。",
                    "_remove_failed": "グループ削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規グループ登録",
                    "_no_data": "グループが存在しません。"
                }
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜スタッフ管理・新規グループ登録",
                "_og_title_edit": "友伸會ポータル管理画面｜スタッフ管理・グループ情報編集",
                "_page_title_create": "新規グループ登録",
                "_page_title_edit": "グループ情報編集",
                "form": {
                    "_subtitle": "グループ情報",
                    "_name_pl": "グループ名を入力してください",
                    "_memo_pl": "メモを入力してください"
                },
                "messages": {
                    "_create_success": "グループ情報の登録が成功しました。",
                    "_create_failed": "グループ情報の登録に失敗しました。",
                    "_edit_success": "グループ情報の編集が成功しました。",
                    "_edit_failed": "グループ情報の編集に失敗しました。"
                },
                "others": {
                    "_btn_create": "登録する",
                    "_btn_edit": "編集する",
                    "_btn_remove": "削除する"
                }
            },
            "group_users": {
                "_og_title": "友伸會ポータル管理画面｜スタッフ管理・グループユーザー登録",
                "_page_title": "グループユーザー登録",
                "_not_found_user": "ユーザーが見つかりません",
                "data_table": {
                    "_cur_staff_count": "現在のスタッフ数"
                },
                "messages": {
                    "_update_success": "グループユーザーの更新が成功しました。",
                    "_update_failed": "グループユーザーの更新に失敗しました。"
                },
                "others": {
                    "_data_result": "データ結果",
                    "_btn_update": "更新する",
                    "_no_data": "ユーザーが存在しません。",
                    "_no_search_result": "該当するユーザー情報が存在しません。"
                }
            },
            "form": {
                "_name": "名前"
            },
            "popup": {
                "_cannot_do_this_action": "このアクションは実行できません"
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "グループを削除",
                "_remove_modal_description": "このグループを削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "pagination": {
            "previous": "&laquo; 前へ",
            "next": "次へ &raquo;"
        },
        "clinic": {
            "attr": {
                "_name": "クリニック名",
                "_prefecture": "都道府県",
                "_zip_code": "郵便番号",
                "_address": "住所",
                "_memo": "メモ"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜スタッフ管理・クリニック一覧",
                "_page_title": "クリニック一覧",
                "data_table": {
                    "_staff_count": "スタッフ数",
                    "actions": {
                        "_act_add_user": "クリニックスタッフを更新する",
                        "_act_edit": "クリニック情報を編集する",
                        "_act_remove": "クリニックを削除する"
                    }
                },
                "messages": {
                    "_remove_success": "クリニック削除が成功しました。",
                    "_remove_failed": "クリニック削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規クリニック登録",
                    "_no_data": "クリニックが存在しません。",
                    "_no_search_result": "該当するクリニックが存在しません。"
                }
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜スタッフ管理・新規クリニック登録",
                "_og_title_edit": "友伸會ポータル管理画面｜スタッフ管理・クリニック情報編集",
                "_page_title_create": "新規クリニック登録",
                "_page_title_edit": "クリニック情報編集",
                "form": {
                    "_form_title": "クリニック情報",
                    "_name_pl": "クリニック名を入力してください",
                    "_prefecture_df": "都道府県を選択してください",
                    "_zip_code_pl": "郵便番号を入力してください",
                    "_address_pl": "住所を入力してください",
                    "_memo_pl": "メモを入力してください"
                },
                "messages": {
                    "_create_success": "クリニック情報の登録が成功しました。",
                    "_create_failed": "クリニック情報の登録に失敗しました。",
                    "_edit_success": "クリニック情報の編集が成功しました。",
                    "_edit_failed": "クリニック情報の編集に失敗しました。"
                },
                "others": {
                    "_btn_create": "登録する",
                    "_btn_edit": "編集する",
                    "_btn_remove": "削除する"
                }
            },
            "clinic_users": {
                "_og_title": "友伸會ポータル管理画面｜スタッフ管理・クリニックスタッフ登録",
                "_page_title": "クリニックスタッフ登録",
                "data_table": {
                    "_cur_staff_count": "現在のスタッフ数"
                },
                "messages": {
                    "_update_success": "スタッフ情報の更新が成功しました。",
                    "_update_failed": "スタッフ情報の更新に失敗しました。"
                },
                "others": {
                    "_btn_update": "更新する",
                    "_no_data": "スタッフが存在しません。",
                    "_no_search_result": "該当するスタッフ情報が存在しません。"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "クリニック情報を削除",
                "_remove_modal_description": "このクリニックの情報を削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "auth": {
            "login": {
                "_og_title": "友伸會ポータル管理画面",
                "_page_title": "友伸會ポータル管理画面",
                "form": {
                    "_subtitle": "ログイン",
                    "_mail_address": "メールアドレス",
                    "_mail_address_pl": "メールアドレスを入力してください",
                    "_password": "パスワード",
                    "_password_pl": "パスワードを入力してください"
                },
                "messages": {
                    "_login_failed": "ログインに失敗しました。"
                },
                "others": {
                    "_btn_login": "ログイン",
                    "_link_forgot_password": "パスワードを忘れた方はこちら"
                }
            },
            "reset_pwd": {
                "_og_title": "友伸會ポータル管理画面｜パスワード再設定",
                "_page_title": "友伸會ポータル管理画面",
                "form": {
                    "_subtitle": "パスワード再設定",
                    "_mail_address": "メールアドレス",
                    "_mail_address_pl": "メールアドレスを入力してください"
                },
                "messages": {
                    "_send_mail_success": "パスワード再設定のメールを送信しました。",
                    "_send_mail_failed": "パスワード再設定のメール送信に失敗しました。"
                },
                "others": {
                    "_btn_login": "パスワードを再設定",
                    "_link_back_to_login": "ログイン画面へ戻す"
                }
            },
            "title_form": "社内ポータルサイト",
            "email_title": "メールアドレス",
            "email_holder": "メールアドレスを入力してください",
            "password_title": "パスワード",
            "password_holder": "パスワードを入力してください",
            "btn_login": "ログイン",
            "title_login": "ログイン",
            "forgot_password": "パスワードを忘れた方はこちら?",
            "title_reset": "パスワードを忘れた方はこちら?",
            "confirm_password": "パスワードを認証する",
            "reset_btn": "リセット",
            "failed": "ログインに失敗しました。"
        }
    },
    "ja": {
        "request": {
            "attr": {
                "_title": "タイトル",
                "_category": "申請項目",
                "_sender": "申請者",
                "_approver": "承認担当者",
                "_status": "ステータス",
                "status": {
                    "_open": "承認待ち",
                    "_in_progress": "承認中",
                    "_approved": "承認済み",
                    "_rejected": "却下"
                },
                "_all_approval": "全員承認",
                "_approval_comment": "承認欄",
                "approval_comment": {
                    "_yes": "あり",
                    "_no": "なし"
                },
                "_memo": "メモ"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜申請管理・申請一覧",
                "_page_title": "申請一覧",
                "search_box": {
                    "_status_df": "すべてのステータス"
                },
                "data_table": {
                    "_request_at": "申請日時",
                    "_last_approved_at": "最終承認日時",
                    "_action": "操作",
                    "actions": {
                        "_act_show_details": "詳細を確認する",
                        "_act_approve": "承認する",
                        "_act_reject": "却下する"
                    }
                },
                "messages": {
                    "_approve_success": "申請承認が成功しました。",
                    "_approve_failed": "申請承認に失敗しました。",
                    "_reject_success": "申請ステータスの更新が成功しました。",
                    "_reject_failed": "申請ステータスの更新に失敗しました。"
                },
                "others": {
                    "_no_data": "申請データが存在しません。",
                    "_no_search_result": "該当する申請データが存在しません。"
                }
            },
            "info": {
                "_og_title": "友伸會ポータル管理画面｜申請管理・申請詳細情報",
                "_page_title": "申請詳細情報",
                "basic_info": {
                    "_subtitle": "基本情報",
                    "_approval_comment_pl": "例）精算額など"
                },
                "form": {
                    "_subtitle": "申請情報"
                },
                "reply_form": {
                    "_comment_pl": "コメントを入力してください"
                },
                "messages": {
                    "_approve_success": "申請承認が成功しました。",
                    "_approve_failed": "申請承認に失敗しました。",
                    "_reject_success": "申請ステータスの更新が成功しました。",
                    "_reject_failed": "申請ステータスの更新に失敗しました。",
                    "_reply_success": "返信が成功しました。",
                    "_reply_failed": "返信に失敗しました。"
                },
                "others": {
                    "_btn_approve": "承認する",
                    "_btn_reject": "却下する",
                    "_btn_reply": "返信する"
                }
            },
            "discussion": {
                "_title": "コメント",
                "form": {
                    "_input_comment_pl": "メッセージを入力してください",
                    "_input_select_file_pl": "アップロードするファイルを選択、またはファイルをドラッグ＆ドロップします",
                    "_input_drop_file_pl": "ここにファイルをドロップします。"
                },
                "messages": {
                    "_comment_success": "コメント投稿が成功しました。",
                    "_comment_failed": "コメント投稿に失敗しました。"
                },
                "others": {
                    "_btn_comment": "送信する",
                    "_no_data": "表示されるコメントはまだありません。"
                }
            },
            "template": {
                "list": {
                    "_og_title_": "友伸會ポータル管理画面｜申請管理・申請テンプレート一覧",
                    "_page_title": "申請テンプレート一覧",
                    "data_table": {
                        "_created_at": "作成日時",
                        "actions": {
                            "_act_edit": "編集する",
                            "_act_remove": "削除する"
                        }
                    },
                    "messages": {
                        "_remove_success": "申請テンプレートの削除が成功しました。",
                        "_remove_failed": "申請テンプレートの削除に失敗しました。"
                    },
                    "others": {
                        "_btn_draft_save": "下書きとして保存する",
                        "_btn_create": "新規テンプレート作成",
                        "_no_data": "申請テンプレートが存在しません。"
                    }
                },
                "info": {
                    "_og_title_create": "友伸會ポータル管理画面｜申請管理・申請テンプレート編集",
                    "_page_title_create": "新規テンプレート作成",
                    "_page_title_edit": "申請テンプレート編集",
                    "basic_form": {
                        "_subtitle": "基本情報",
                        "_title_pl": "申請テンプレートのタイトルを入力してください",
                        "_approver_pl": "承認担当者のアカウント名を指定してください",
                        "_category_df": "カテゴリーを選択してください",
                        "_memo_pl": "メモを入力してください"
                    },
                    "question_form": {
                        "_subtitle": "申請情報",
                        "_description": "※右側の設問テンプレートから申請項目ゾーンにドラッグ・ドロップし、設問の詳細を定義してください。"
                    },
                    "messages": {
                        "_create_success": "新規申請テンプレートの作成が成功しました。",
                        "_create_failed": "新規申請テンプレートの作成に失敗しました。",
                        "_edit_success": "新規申請テンプレートの編集が成功しました。",
                        "_edit_failed": "新規申請テンプレートの編集に失敗しました。",
                        "_draft_save_success": "申請テンプレートのの下書き保存が成功しました。",
                        "_draft_save_failed": "申請テンプレートのの下書き保存に失敗しました。",
                        "_delete_success": "申請テンプレートの削除が成功しました。",
                        "_delete_failed": "申請テンプレートの削除に失敗しました。"
                    },
                    "others": {
                        "_btn_draft_save": "下書きとして保存",
                        "_btn_create": "作成する",
                        "_btn_edit": "編集する",
                        "_no_data": "申請テンプレートが存在しません。"
                    }
                }
            },
            "others": {
                "_modal_no": "キャンセル",
                "_modal_yes": "はい",
                "_reject_modal_title": "申請をリジェクト",
                "_reject_modal_description": "この申請をリジェクトしてもよろしいですか？",
                "_approve_modal_title": "申請を承認",
                "_approve_modal_description": "この申請を却下してもよろしいですか？"
            },
            "common": {
                "number_file_upload_greater_than": "ファイルは５つまでアップロードしてください。"
            }
        },
        "app": {
            "name": "友伸會ポータル管理画面",
            "menu": {
                "top": {
                    "_logout": "ログアウト",
                    "_profile": "マイアカウント"
                },
                "sidebar": {
                    "admin_management": {
                        "_main": "管理者アカウント管理",
                        "_admin_list": "管理者一覧",
                        "_role_list": "管理者役割一覧"
                    },
                    "staff_management": {
                        "_main": "スタッフ管理",
                        "_clinic_list": "クリニック一覧",
                        "_staff_list": "スタッフ一覧",
                        "_group_list": "グループ一覧"
                    },
                    "notification_management": {
                        "_main": "お知らせ管理"
                    },
                    "request_management": {
                        "_main": "申請管理",
                        "_request_template_list": "申請テンプレート一覧"
                    },
                    "inquiry_management": {
                        "_main": "問合せ管理"
                    },
                    "page_management": {
                        "_main": "ページ管理"
                    }
                }
            }
        },
        "staff": {
            "attr": {
                "_username": "ユーザー名",
                "_mail_address": "メールアドレス",
                "_position": "職業",
                "positions": {
                    "_dr": "DR",
                    "_dh": "DH",
                    "_others": "その他"
                },
                "_clinic": "クリニック",
                "_user_type": "ユーザータイプ",
                "_memo": "メモ"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜スタッフ管理・スタッフ一覧",
                "_page_title": "スタッフ一覧",
                "search_box": {
                    "_position_df": "すべての職業",
                    "_clinic_df": "すべてのクリニック",
                    "_keyword": "キーワード",
                    "_keyword_pl": "キーワードを入力してください"
                },
                "data_table": {
                    "_registered_at": "登録日時",
                    "_last_login_at": "最終ログイン日時",
                    "actions": {
                        "_act_edit": "スタッフ情報を編集する",
                        "_act_remove": "スタッフ情報を削除する"
                    }
                },
                "messages": {
                    "_remove_success": "スタッフ情報の削除が成功しました。",
                    "_remove_failed": "スタッフ情報の削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規スタッフ登録",
                    "_no_data": "スタッフが存在しません。",
                    "_no_search_result": "該当するスタッフ情報が存在しません。"
                }
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜スタッフ管理・新規スタッフ情報登録",
                "_og_title_edit": "友伸會ポータル管理画面｜スタッフ管理・スタッフ情報編集",
                "_page_title_create": "新規スタッフ登録",
                "_page_title_edit": "スタッフ情報編集",
                "form": {
                    "_form_title": "スタッフ情報",
                    "_username_pl": "ユーザー名を入力してください",
                    "_mail_address_pl": "メールアドレスを入力してください",
                    "_position_df": "職業を選択してください",
                    "_clinic_df": "クリニックを指定してください",
                    "user_type_opt": {
                        "_staff_web": "ウェブユーザー",
                        "_staff_mobile": "スマホアプリユーザー"
                    },
                    "_memo_pl": "メモを入力してください"
                },
                "messages": {
                    "_create_success": "新規スタッフの登録が成功しました。",
                    "_create_failed": "新規スタッフの登録に失敗しました。",
                    "_edit_success": "スタッフ情報の編集が成功しました。",
                    "_edit_failed": "スタッフ情報の編集に失敗しました。"
                },
                "others": {
                    "_btn_create": "登録する",
                    "_btn_edit": "編集する",
                    "_btn_remove": "削除する"
                }
            },
            "my_account": {
                "_page_title": "マイアカウント",
                "form": {
                    "_cur_password": "現在のパスワード",
                    "_cur_password_pl": "現在のパスワードを入力してください",
                    "_new_password": "新しいパスワード",
                    "_new_password_pl": "新しいパスワードを入力してください",
                    "_confirm_password": "新しいパスワード（確認用）",
                    "_confirm_password_pl": "確認用パスワードを入力してください"
                },
                "messages": {
                    "_current_pwd_not_match": "現在のパスワードは古いパスワードと一致しません。",
                    "_pwd_update_success": "パスワード再設定が成功しました。",
                    "_pwd_update_failed": "パスワード再設定に失敗しました。"
                },
                "others": {
                    "_btn_update_pwd": "再設定する"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "スタッフ情報を削除",
                "_remove_modal_description": "このスタッフの情報を削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "passwords": {
            "reset": "パスワードをリセットしました。",
            "sent": "パスワードリマインダーを送信しました。",
            "throttled": "時間を置いて再度お試しください。",
            "token": "パスワード再設定トークンの有効期限が切れました。",
            "user": "このメールアドレスに一致するユーザーを見つけることが出来ませんでした。"
        },
        "admin": {
            "attr": {
                "_username": "アカウント名",
                "_mail_address": "メールアドレス",
                "_position": "ポジション",
                "_role": "管理者役割",
                "_memo": "メモ"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜管理者アカウント管理・管理者一覧",
                "_page_title": "管理者一覧",
                "search_box": {
                    "_role_df": "すべての役割"
                },
                "data_table": {
                    "_registered_at": "登録日時",
                    "_last_login_at": "最終ログイン日時",
                    "actions": {
                        "_act_edit": "管理者情報を編集する",
                        "_act_remove": "管理者情報を削除する"
                    }
                },
                "messages": {
                    "_remove_success": "管理者情報の削除が成功しました。",
                    "_remove_failed": "管理者情報の削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規アカウント登録",
                    "_no_data": "管理者アカウントが存在しません。",
                    "_no_search_result": "該当する管理者情報が存在しません。"
                }
            },
            "my_account": {
                "_page_title": "マイアカウント",
                "basic_info": {
                    "_title": "アカウント情報",
                    "messages": {
                        "_acc_update_success": "管理者情報の編集が成功しました。",
                        "_acc_update_failed": "管理者情報の編集に失敗しました。"
                    },
                    "others": {
                        "_btn_update": "更新する"
                    }
                },
                "change_pwd": {
                    "_title": "パスワード再設定",
                    "form": {
                        "_cur_password": "現在のパスワード",
                        "_cur_password_pl": "現在のパスワードを入力してください",
                        "_new_password": "新しいパスワード",
                        "_new_password_pl": "新しいパスワードを入力してください",
                        "_confirm_password": "新しいパスワード（確認用）",
                        "_confirm_password_pl": "確認用パスワードを入力してください"
                    },
                    "messages": {
                        "_current_pwd_not_match": "現在のパスワードは古いパスワードと一致しません。",
                        "_pwd_update_success": "パスワード再設定が成功しました。",
                        "_pwd_update_failed": "パスワード再設定に失敗しました。"
                    },
                    "others": {
                        "_btn_update_pwd": "再設定する"
                    }
                }
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜管理者アカウント管理・新規アカウント登録",
                "_og_title_edit": "友伸會ポータル管理画面｜管理者アカウント管理・管理者情報編集",
                "_page_title_create": "新規アカウント登録",
                "_page_title_edit": "管理者情報編集",
                "form": {
                    "_form_title": "管理者情報",
                    "_username_pl": "アカウント名を入力してください",
                    "_mail_address_pl": "メールアドレスを入力してください",
                    "_position_df": "ポジションを選択してください",
                    "position_opt": {
                        "_bod": "理事長",
                        "_hr": "事務局"
                    },
                    "_memo_pl": "メモを入力してください"
                },
                "messages": {
                    "_create_success": "管理者アカウントの登録が成功しました。",
                    "_create_failed": "管理者アカウントの登録に失敗しました。",
                    "_edit_success": "管理者情報の編集が成功しました。",
                    "_edit_failed": "管理者情報の編集に失敗しました。"
                },
                "others": {
                    "_btn_create": "登録する",
                    "_btn_edit": "更新する",
                    "_btn_remove": "削除する"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "管理者情報を削除",
                "_remove_modal_description": "この管理者の情報を削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "notification": {
            "attr": {
                "_title": "タイトル",
                "_target_users": "送信対象者",
                "_confirm_required": "承認必須",
                "_content": "本文",
                "_public_at": "公開日時",
                "_status": "ステータス",
                "status": {
                    "_draft": "下書き",
                    "_private": "非公開",
                    "_public": "公開"
                }
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜お知らせ管理・お知らせ一覧",
                "_page_title": "お知らせ一覧",
                "search_box": {
                    "_target_users_df": "すべてのスタッフ",
                    "_public_date": "公開日付",
                    "_status": "公開ステータス",
                    "_status_df": "すべてのステータス"
                },
                "data_table": {
                    "_sent_count": "配送総数",
                    "_read_count": "既読数",
                    "_confirmed_count": "確認済人数",
                    "actions": {
                        "_act_public": "お知らせを公開する",
                        "_act_edit": "編集する",
                        "_act_remove": "削除する",
                        "_act_show_details": "詳細を確認んする",
                        "_act_show_list_user": "送信対象者一覧を確認する"
                    }
                },
                "messages": {
                    "_remove_success": "お知らせ削除が成功しました。",
                    "_remove_failed": "お知らせ削除に失敗しました。",
                    "_stt_update_success": "お知らせステータスの更新が成功しました。",
                    "_stt_update_failed": "お知らせステータスの更新に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規お知らせ作成",
                    "_no_data": "お知らせデータが存在しません。",
                    "_no_search_result": "該当するお知らせデータが存在しません。"
                }
            },
            "info": {
                "_og_title": "友伸會ポータル管理画面｜お知らせ管理・お知らせ作成",
                "_page_title": "お知らせ作成",
                "_page_title_edit": "お知らせ編集",
                "form": {
                    "_subtitle": "お知らせ情報",
                    "_title_pl": "タイトルを入力してください",
                    "_target_users_des": "※拠点名、職業、及びユーザー名で入力することは可能です。",
                    "target_user_opt": {
                        "_dr": "DR",
                        "_dh": "DH",
                        "_all": "全クリニック",
                        "_manual": "対象者を指定する",
                        "_manual_pl": "送信対象者のユーザー名を入力してください"
                    }
                },
                "messages": {
                    "_create_success": "お知らせ作成が成功しました。",
                    "_create_failed": "お知らせ作成に失敗しました。",
                    "_draft_save_success": "お知らせの下書き保存が成功しました。",
                    "_draft_save_failed": "お知らせの下書き保存に失敗しました。",
                    "_err_title_required": "タイトルを必ず必ず入力してください。",
                    "_err_target_required": "送信対象者を必ず指定してください。",
                    "_err_content_required": "お知らせ本文を必ず入力してください。",
                    "_err_schedule_required": "公開日時を必ず指定してください。",
                    "_err_schedule_lt_now": "公開日時を正しく指定してください。",
                    "_err_content_gt_500": "The length of content less than 500 characters"
                },
                "others": {
                    "_btn_draft_save": "下書きとして保存する",
                    "_btn_create": "公開する",
                    "_btn_remove": "削除する"
                }
            },
            "noti_users": {
                "_og_title": "友伸會ポータル管理画面｜お知らせ管理・送信対象者一覧",
                "_page_title": "送信対象者一覧",
                "attr": {
                    "_status": "ステータス",
                    "status": {
                        "_unread": "未読",
                        "_read": "既読",
                        "_unconfirmed": "未確認",
                        "_confirmed": "確認済"
                    }
                },
                "search_box": {
                    "_status_df": "すべてのステータス"
                },
                "data_table": {
                    "_confirmed_at": "確認日時"
                },
                "others": {
                    "_unconfirm": "---",
                    "_no_data": "送信対象者が存在しません。",
                    "_no_search_result": "該当するユーザー情報が存在しません。"
                }
            },
            "web": {
                "_og_title": "友伸會ポータル管理画面｜お知らせ一覧",
                "_page_title": "お知らせ一覧",
                "data_table": {
                    "_tab_all": "すべて",
                    "_tab_bod": "理事長から",
                    "_tab_hr": "事務局から"
                },
                "others": {
                    "_no_data": "表示するお知らせはまだありません。"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "お知らせを削除",
                "_remove_modal_description": "このお知らせを削除してもよろしいですか？一度削除されたお知らせは復旧することはできません。"
            }
        },
        "role": {
            "attr": {
                "_name": "役割",
                "_permission": "権限"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜管理者アカウント管理・管理者役割一覧",
                "_page_title": "管理者役割一覧",
                "data_table": {
                    "actions": {
                        "_act_edit": "編集する",
                        "_act_remove": "削除する"
                    }
                },
                "messages": {
                    "_remove_success": "管理者役割の削除が成功しました。",
                    "_remove_failed": "管理者役割の削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規役割登録",
                    "_no_data": "管理者役割が存在しません。"
                }
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜管理者アカウント管理・新規役割登録",
                "_og_title_edit": "友伸會ポータル管理画面｜管理者アカウント管理・管理者役割編集",
                "_page_title_create": "新規役割登録",
                "_page_title_edit": "管理者役割編集",
                "form": {
                    "_form_title": "管理者役割情報",
                    "_name_pl": "管理者役割の名前を入力してください",
                    "permission_data": {
                        "_feature_list": "機能一覧",
                        "_all_permission": "すべての権限",
                        "_read": "読み取り",
                        "_create": "作成",
                        "_update": "更新",
                        "_remove": "削除",
                        "features": {
                            "_admin_management": "管理者アカウント管理",
                            "_role_management": "管理者役割管理",
                            "_clinic_management": "クリニック管理",
                            "_group_management": "グループ管理",
                            "_staff_management": "スタッフ管理",
                            "_notification_management": "お知らせ管理",
                            "_request_management": "申請管理",
                            "_request_template_management": "申請テンプレート管理",
                            "_inquiry_management": "問合せ管理",
                            "_page_management": "ページ管理"
                        }
                    }
                },
                "messages": {
                    "_create_success": "管理者役割の登録が成功しました。",
                    "_create_failed": "管理者役割の登録に失敗しました。",
                    "_edit_success": "管理者役割の編集が成功しました。",
                    "_edit_failed": "管理者役割の編集に失敗しました。"
                },
                "others": {
                    "_btn_create": "登録する",
                    "_btn_edit": "編集する",
                    "_btn_remove": "削除する"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "管理者役割を削除",
                "_remove_modal_description": "この管理者役割を削除してもよろしいですか？一度削除された情報は復旧することはできません。",
                "_remove_success": "役割を削除しました"
            }
        },
        "inquiry": {
            "attr": {
                "_title": "申請項目",
                "_category": "申請項目",
                "_sender": "申請者",
                "_status": "ステータス",
                "status": {
                    "_open": "承認待ち",
                    "_closed": "クローズする"
                },
                "_all_approval": "全員承認",
                "_approval_comment": "承認欄",
                "approval_comment": {
                    "_yes": "あり",
                    "_no": "なし"
                }
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜問合せ管理・問合せ一覧",
                "_page_title": "問合せ一覧",
                "search_box": {
                    "_status_df": "すべてのステータス"
                },
                "data_table": {
                    "_requested_at": "問合せ日",
                    "_closed_at": "最終回答日",
                    "_status": "ステータス",
                    "_username": "ユーザー名",
                    "_title": "題名",
                    "_action": "操作",
                    "actions": {
                        "_act_show_details": "詳細を見る",
                        "_act_close": "クローズする"
                    }
                },
                "messages": {
                    "_close_success": "問合せをクローズしました。",
                    "_close_failed": "問合せのステータス変更に失敗しました。"
                },
                "others": {
                    "_no_data": "問合せが存在しません。",
                    "_no_search_result": "該当する問合せが存在しません。"
                },
                "search": {
                    "_status": "ステータス",
                    "_status_place_holder": "全てのステータス",
                    "_time_range": "問合せ日付",
                    "_keyword": "キーワード"
                }
            },
            "info": {
                "_og_title": "友伸會ポータル管理画面｜問合せ管理・問合せ詳細情報",
                "_page_title": "問合せ詳細情報",
                "basic_info": {
                    "_subtitle": "基本情報"
                },
                "form": {
                    "_subtitle": "問合せ内容",
                    "_title": "題名",
                    "_content": "内容"
                },
                "reply_form": {
                    "_comment_pl": "コメントを入力してください"
                },
                "others": {
                    "_btn_close": "クローズする"
                }
            },
            "discussion": {
                "_title": "コメント",
                "form": {
                    "_input_comment_pl": "メッセージを入力してください",
                    "_input_select_file_pl": "アップロードするファイルを選択、またはファイルをドラッグ＆ドロップします",
                    "_input_drop_file_pl": "ここにファイルをドロップします。"
                },
                "messages": {
                    "_comment_success": "コメント投稿が成功しました。",
                    "_comment_failed": "コメント投稿に失敗しました。"
                },
                "others": {
                    "_btn_comment": "送信する",
                    "_no_data": "表示されるコメントはまだありません。"
                }
            },
            "others": {
                "_close_modal_yes": "はい",
                "_close_modal_no": "いいえ",
                "_close_modal_title": "問合せをクローズ",
                "_close_modal_description": "この問合せをクローズしてもよろしいですか？"
            }
        },
        "validation": {
            "accepted": "{attribute}を承認してください。",
            "active_url": "{attribute}は、有効なURLではありません。",
            "after": "{attribute}には、{date}以降の日付を指定してください。",
            "after_or_equal": "{attribute}には、{date}以降もしくは同日時を指定してください。",
            "alpha": "{attribute}には、アルファベッドのみ使用できます。",
            "alpha_dash": "{attribute}には、英数字('A-Z','a-z','0-9')とハイフンと下線('-','_')が使用できます。",
            "alpha_num": "{attribute}には、英数字('A-Z','a-z','0-9')が使用できます。",
            "array": "{attribute}には、配列を指定してください。",
            "before": "{attribute}には、{date}以前の日付を指定してください。",
            "before_or_equal": "{attribute}には、{date}以前もしくは同日時を指定してください。",
            "between": {
                "numeric": "{attribute}には、{min}から、{max}までの数字を指定してください。",
                "file": "{attribute}には、{min} KBから{max} KBまでのサイズのファイルを指定してください。",
                "string": "{attribute}は、{min}文字から{max}文字にしてください。",
                "array": "{attribute}の項目は、{min}個から{max}個にしてください。"
            },
            "boolean": "{attribute}には、'true'か'false'を指定してください。",
            "confirmed": "{attribute}と{attribute}確認が一致しません。",
            "date": "{attribute}は、正しい日付ではありません。",
            "date_format": "{attribute}の形式は、'{format}'と合いません。",
            "different": "{attribute}と{other}には、異なるものを指定してください。",
            "digits": "{attribute}は、{digits}桁にしてください。",
            "digits_between": "{attribute}は、{min}桁から{max}桁にしてください。",
            "dimensions": "{attribute}は、正しい縦横比ではありません。",
            "distinct": "{attribute}に重複した値があります。",
            "email": "{attribute}は、有効なメールアドレス形式で指定してください。",
            "exists": "選択された{attribute}は、有効ではありません。",
            "file": "{attribute}はファイルでなければいけません。",
            "filled": "{attribute}は必須です。",
            "image": "{attribute}には、画像を指定してください。",
            "in": "選択された{attribute}は、有効ではありません。",
            "in_array": "{attribute}は、{other}に存在しません。",
            "integer": "{attribute}には、整数を指定してください。",
            "ip": "{attribute}には、有効なIPアドレスを指定してください。",
            "ipv4": "{attribute}はIPv4アドレスを指定してください。",
            "ipv6": "{attribute}はIPv6アドレスを指定してください。",
            "json": "{attribute}には、有効なJSON文字列を指定してください。",
            "max": {
                "numeric": "{attribute}には、{max}以下の数字を指定してください。",
                "file": "{attribute}には、{max} KB以下のファイルを指定してください。",
                "string": "{attribute}は、{max}文字以下にしてください。",
                "array": "{attribute}の項目は、{max}個以下にしてください。"
            },
            "mimes": "{attribute}には、{values}タイプのファイルを指定してください。",
            "mimetypes": "{attribute}には、{values}タイプのファイルを指定してください。",
            "min": {
                "numeric": "{attribute}には、{min}以上の数字を指定してください。",
                "file": "{attribute}には、{min} KB以上のファイルを指定してください。",
                "string": "{attribute}は、{min}文字以上にしてください。",
                "array": "{attribute}の項目は、{max}個以上にしてください。"
            },
            "not_in": "選択された{attribute}は、有効ではありません。",
            "not_regex": "{attribute} は整数で入力してください",
            "numeric": "{attribute}には、数字を指定してください。",
            "present": "{attribute}は、必ず存在しなくてはいけません。",
            "regex": "{attribute}には、有効な正規表現を指定してください。",
            "required": "必ず入力してください。",
            "required_if": "{other}が{value}の場合、{attribute}を指定してください。",
            "required_unless": "{other}が{value}以外の場合、{attribute}を指定してください。",
            "required_with": "{values}が指定されている場合、{attribute}も指定してください。",
            "required_with_all": "{values}が全て指定されている場合、{attribute}も指定してください。",
            "required_without": "{values}が指定されていない場合、{attribute}を指定してください。",
            "required_without_all": "{values}が全て指定されていない場合、{attribute}を指定してください。",
            "same": "{attribute}と{other}が一致しません。",
            "size": {
                "numeric": "{attribute}には、{size}を指定してください。",
                "file": "{attribute}には、{size} KBのファイルを指定してください。",
                "string": "{attribute}は、{size}文字にしてください。",
                "array": "{attribute}の項目は、{size}個にしてください。"
            },
            "string": "{attribute}には、文字を指定してください。",
            "timezone": "{attribute}には、有効なタイムゾーンを指定してください。",
            "unique": "指定の{attribute}は既に使用されています。",
            "uploaded": "{attribute}のアップロードに失敗しました。",
            "url": "{attribute}は、有効なURL形式で指定してください。",
            "custom": {
                "attribute-name": {
                    "rule-name": "custom-message"
                }
            },
            "attributes": []
        },
        "page": {
            "attr": {
                "_type": "書類",
                "type": {
                    "_blog": "記事",
                    "_faq": "よくある質問",
                    "_manual": "マニュアル",
                    "_other": "---"
                },
                "_title": "タイトル",
                "_public": "公開",
                "_public_date": "公開日時",
                "_status": "全員公開",
                "_url": "公開先",
                "_category": "カテゴリ",
                "_image": "アイキャッチ画像",
                "_summary": "概要",
                "status": {
                    "_public": "公開",
                    "_private": "非公開"
                }
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜ページ管理・ページ一覧",
                "_page_title": "ページ一覧",
                "search_box": {
                    "_type": "書類",
                    "_type_pl": "すべての書類",
                    "_status": "ステータス",
                    "_status_pl": "すべてのステータス",
                    "_date": "公開日付",
                    "_keyword": "キーワード",
                    "_keyword_pl": "キーワードを入力してください",
                    "_btn_clear": "条件をクリアする",
                    "_btn_search": "この条件で検索"
                },
                "data_table": {
                    "_title": "書類タイトル",
                    "_type": "種類",
                    "_category": "カテゴリー",
                    "public_date": "公開日付",
                    "status": "ステータス",
                    "_registered_at": "登録日時",
                    "_last_login_at": "最終ログイン日時",
                    "actions": {
                        "_act_edit": "編集する",
                        "_act_remove": "削除する"
                    }
                },
                "messages": {
                    "_remove_success": "ページの削除が成功しました。",
                    "_remove_failed": "ページの削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規ページ作成",
                    "_no_data": "ページデータが存在しません。",
                    "_no_search_result": "該当するページが存在しません。"
                }
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜ページ管理・新規ページ作成",
                "_og_title_edit": "友伸會ポータル管理画面｜ページ管理・ページ編集",
                "_page_title_create": "新規ページ作成",
                "_page_title_edit": "ページ編集",
                "_basic_info": "基本情報",
                "_article_content": "ページ内容",
                "tabs": {
                    "_manual": "マニュアル設定",
                    "_file": "ファイルアップロード"
                },
                "form": {
                    "_title_pl": "タイトルを入力してください",
                    "_url_pl": "公開先URLを指定してください",
                    "_category_pl": "カテゴリーを指定してください",
                    "_title_upload": "ファイルを選択してください",
                    "_content_upload": "ドキュメント（pdf）、画像ファイル（png, jpg）または動画（mp4）をアップロードしてくだい",
                    "_input_file_desc": "ファイルを選択",
                    "_btn_remove_thumbnail": "アイキャッチ画像を削除する",
                    "_btn_upload": "ファイルを選択",
                    "_btn_remove": "削除する"
                },
                "messages": {
                    "_create_success": "ページ作成が成功しました。",
                    "_create_failed": "ページ作成に失敗しました。",
                    "_edit_success": "ページ内容の編集が成功しました。",
                    "_edit_failed": "ページ内容の編集に失敗しました。",
                    "_change_status_success": "ページのステータス変更が成功しました。",
                    "_change_status_failed": "ページのステータス変更に失敗しました。",
                    "_create_category_success": "カテゴリの作成が成功しました。",
                    "_create_category_failed": "カテゴリの作成に失敗しました。"
                },
                "others": {
                    "_btn_create": "登録する",
                    "_btn_edit": "編集する",
                    "_btn_remove": "削除する",
                    "_show_more": "すべての設定を表示",
                    "_show_less": "主な設定だけ表示"
                },
                "popup": {
                    "_create_title": "ページカテゴリー登録",
                    "_btn_create": "登録する",
                    "_btn_close": "キャンセル",
                    "_btn_show_popup_category": "新しいカテゴリーを追加",
                    "attr": {
                        "_name": "カテゴリー名"
                    }
                }
            },
            "web": {
                "sidemenu": {
                    "_blog_category": "記事カテゴリー",
                    "_faq": "よくある質問",
                    "_manual": "マニュアル",
                    "others": {
                        "_show_more": "もっと見る",
                        "_no_data": "表示する記事はまだありません。"
                    }
                },
                "faq": {
                    "others": {
                        "_no_data": "よくある質問情報は存在しません。"
                    }
                },
                "blog": {
                    "_og_title": "友伸會ポータル管理画面｜記事",
                    "_page_title": "記事",
                    "list": {
                        "_latest_blogs": "最新ニュース",
                        "_show_more": "もっと見る..."
                    },
                    "others": {
                        "_no_data": "表示する記事はまだありません。"
                    }
                },
                "manual": {
                    "_og_title": "友伸會ポータル管理画面｜マニュアル一覧",
                    "_page_title": "マニュアル一覧",
                    "others": {
                        "_no_data": "マニュアル情報は存在しません。"
                    }
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "管理者情報を削除",
                "_remove_modal_description": "この管理者の情報を削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "common": {
            "list": {
                "search_box": {
                    "_keyword": "キーワード",
                    "_keyword_pl": "キーワードを入力してください",
                    "_btn_reset": "条件をクリアする",
                    "_btn_search": "この条件で検索"
                },
                "data_table": {
                    "_id": "#",
                    "_actions": "操作"
                }
            },
            "messages": {
                "_system_err": "システムエラーが発生しました。しばらく時間をおいてから再度お試しください。",
                "_not_found": "Not Found。"
            }
        },
        "group": {
            "attr": {
                "_name": "グループ名",
                "_memo": "メモ"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜スタッフ管理・グループ一覧",
                "_page_title": "グループ一覧",
                "data_table": {
                    "_staff_count": "ユーザー数",
                    "actions": {
                        "_act_add_user": "グループユーザーを更新する",
                        "_act_edit": "グループ情報を編集する",
                        "_act_remove": "グループを削除する"
                    }
                },
                "messages": {
                    "_remove_success": "グループ削除が成功しました。",
                    "_remove_failed": "グループ削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規グループ登録",
                    "_no_data": "グループが存在しません。"
                }
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜スタッフ管理・新規グループ登録",
                "_og_title_edit": "友伸會ポータル管理画面｜スタッフ管理・グループ情報編集",
                "_page_title_create": "新規グループ登録",
                "_page_title_edit": "グループ情報編集",
                "form": {
                    "_subtitle": "グループ情報",
                    "_name_pl": "グループ名を入力してください",
                    "_memo_pl": "メモを入力してください"
                },
                "messages": {
                    "_create_success": "グループ情報の登録が成功しました。",
                    "_create_failed": "グループ情報の登録に失敗しました。",
                    "_edit_success": "グループ情報の編集が成功しました。",
                    "_edit_failed": "グループ情報の編集に失敗しました。"
                },
                "others": {
                    "_btn_create": "登録する",
                    "_btn_edit": "編集する",
                    "_btn_remove": "削除する"
                }
            },
            "group_users": {
                "_og_title": "友伸會ポータル管理画面｜スタッフ管理・グループユーザー登録",
                "_page_title": "グループユーザー登録",
                "_not_found_user": "ユーザーが見つかりません",
                "data_table": {
                    "_cur_staff_count": "現在のスタッフ数"
                },
                "messages": {
                    "_update_success": "グループユーザーの更新が成功しました。",
                    "_update_failed": "グループユーザーの更新に失敗しました。"
                },
                "others": {
                    "_data_result": "データ結果",
                    "_btn_update": "更新する",
                    "_no_data": "ユーザーが存在しません。",
                    "_no_search_result": "該当するユーザー情報が存在しません。"
                }
            },
            "form": {
                "_name": "名前",
                "_unique": "指定の名前は既に使用されています"
            },
            "popup": {
                "_cannot_do_this_action": "このアクションは実行できません"
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "グループを削除",
                "_remove_modal_description": "このグループを削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "pagination": {
            "previous": "&laquo; 前へ",
            "next": "次へ &raquo;"
        },
        "clinic": {
            "attr": {
                "_name": "クリニック名",
                "_prefecture": "都道府県",
                "_zip_code": "郵便番号",
                "_address": "住所",
                "_memo": "メモ"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜スタッフ管理・クリニック一覧",
                "_page_title": "クリニック一覧",
                "data_table": {
                    "_staff_count": "スタッフ数",
                    "actions": {
                        "_act_add_user": "クリニックスタッフを更新する",
                        "_act_edit": "クリニック情報を編集する",
                        "_act_remove": "クリニックを削除する"
                    }
                },
                "messages": {
                    "_remove_success": "クリニック削除が成功しました。",
                    "_remove_failed": "クリニック削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規クリニック登録",
                    "_no_data": "クリニックが存在しません。",
                    "_no_search_result": "該当するクリニックが存在しません。"
                }
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜スタッフ管理・新規クリニック登録",
                "_og_title_edit": "友伸會ポータル管理画面｜スタッフ管理・クリニック情報編集",
                "_page_title_create": "新規クリニック登録",
                "_page_title_edit": "クリニック情報編集",
                "form": {
                    "_form_title": "クリニック情報",
                    "_name_pl": "クリニック名を入力してください",
                    "_prefecture_df": "都道府県を選択してください",
                    "_zip_code_pl": "郵便番号を入力してください",
                    "_address_pl": "住所を入力してください",
                    "_memo_pl": "メモを入力してください"
                },
                "messages": {
                    "_create_success": "クリニック情報の登録が成功しました。",
                    "_create_failed": "クリニック情報の登録に失敗しました。",
                    "_edit_success": "クリニック情報の編集が成功しました。",
                    "_edit_failed": "クリニック情報の編集に失敗しました。"
                },
                "others": {
                    "_btn_create": "登録する",
                    "_btn_edit": "編集する",
                    "_btn_remove": "削除する"
                }
            },
            "clinic_users": {
                "_og_title": "友伸會ポータル管理画面｜スタッフ管理・クリニックスタッフ登録",
                "_page_title": "クリニックスタッフ登録",
                "data_table": {
                    "_cur_staff_count": "現在のスタッフ数"
                },
                "messages": {
                    "_update_success": "スタッフ情報の更新が成功しました。",
                    "_update_failed": "スタッフ情報の更新に失敗しました。"
                },
                "others": {
                    "_btn_update": "更新する",
                    "_no_data": "スタッフが存在しません。",
                    "_no_search_result": "該当するスタッフ情報が存在しません。"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "クリニック情報を削除",
                "_remove_modal_description": "このクリニックの情報を削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "auth": {
            "attr": {
                "_mail_address": "メールアドレス",
                "_password": "パスワード",
                "_new_password": "新しいパスワード",
                "_confirm_password": "新しいパスワード（確認用）"
            },
            "login": {
                "_og_title": "友伸會ポータル管理画面",
                "_page_title": "友伸會ポータル管理画面",
                "form": {
                    "_form_title": "ログイン"
                },
                "messages": {
                    "_login_failed": "ログインに失敗しました。",
                    "_login_banned": "ログインの試行回数が多すぎます。{seconds} 秒後にお試しください。"
                },
                "others": {
                    "_btn_login": "ログインする",
                    "_link_forgot_password": "パスワードを忘れた方はこちら",
                    "_staff_mobile_user_cant_login": "ログインに失敗しました。"
                }
            },
            "forgot_pwd": {
                "_og_title": "友伸會ポータル管理画面｜パスワード再設定",
                "_page_title": "友伸會ポータル管理画面",
                "form": {
                    "_form_title": "パスワード再設定メール送信"
                },
                "messages": {
                    "_send_mail_success": "パスワード再設定のメールを送信しました。",
                    "_send_mail_failed": "パスワード再設定のメール送信に失敗しました。"
                },
                "others": {
                    "_btn_send": "メールを送信する",
                    "_link_back_to_login": "ログイン画面へ戻す"
                }
            },
            "reset_pwd": {
                "_og_title": "友伸會ポータル管理画面｜パスワード再設定",
                "_page_title": "友伸會ポータル管理画面",
                "form": {
                    "_form_title": "パスワード再設定"
                },
                "validate": {
                    "min_6": "新しいパスワードは６文字以上に入力してください。",
                    "max_20": "新しいパスワードは20文字以下に入力してください。",
                    "confirmed": "確認用のパスワードと新しいパスワードが一致しません。"
                },
                "messages": {
                    "_send_mail_success": "パスワード再設定のメールを送信しました。",
                    "_send_mail_failed": "パスワード再設定のメール送信に失敗しました。"
                },
                "others": {
                    "_btn_reset": "パスワードを再設定する",
                    "_link_back_to_login": "ログイン画面へ戻す"
                }
            },
            "confirm_pwd": {
                "validate": {
                    "min_6": "確認用のパスワードは６文字以上に入力してください。",
                    "max_20": "確認用のパスワードは20文字以下に入力してください。"
                }
            }
        }
    }
}
