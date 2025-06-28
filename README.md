# keyword-updater-plugin-
Atualize palavras-chave do plugin Internal Link Juicer via API REST no WordPress. Ideal para automações e integrações com n8n, Make, etc.

# Keyword Updater Plugin (Extensão para Internal Link Juicer)

Este plugin é uma **extensão para o plugin [Internal Link Juicer](https://www.internallinkjuicer.com/)**, que permite **atualizar as palavras-chave de um post via requisição HTTP (REST API)**. Ideal para integrar com ferramentas de automação como **n8n, Make.com, Zapier** ou scripts personalizados.

## ✨ Funcionalidades

- Atualização remota de palavras-chave definidas no ILJ.
- Requisição simples via `POST` para endpoint personalizado.
- Suporte tanto a **string única** quanto a **array de palavras-chave**.
- Disparo automático da reconstrução dos links internos após atualização.

## ✅ Requisitos

- WordPress com permissão para instalar plugins.
- Plugin **[Internal Link Juicer](https://www.internallinkjuicer.com/)** previamente instalado e ativado.
- PHP 7.4 ou superior.

## 📦 Instalação

1. Baixe ou clone este repositório:
   ``
   git clone https://github.com/seu-usuario/keyword-updater-plugin.git
``

2. Envie a pasta `keyword-updater-plugin` para:

   ```
   wp-content/plugins/
   ```

3. No painel do WordPress, acesse **Plugins > Plugins instalados** e ative o **Keyword Updater Plugin**.


## 🔄 Como usar

### Endpoint da API

```
POST /wp-json/keyword-updater/v1/update/
```

### Parâmetros aceitos

| Parâmetro  | Tipo                | Obrigatório | Descrição                                     |
| ---------- | ------------------- | ----------- | --------------------------------------------- |
| `post_id`  | `int`               | Sim         | ID do post onde a palavra-chave será aplicada |
| `keywords` | `string` ou `array` | Sim         | Palavra-chave única ou array de palavras      |

### Exemplo com `curl`

```bash
curl -X POST https://seusite.com/wp-json/keyword-updater/v1/update/ \
  -H "Content-Type: application/json" \
  -d '{
    "post_id": 123,
    "keywords": "inteligência artificial"
  }'
```

### Exemplo com `n8n` (HTTP Request node)

* Método: `POST`
* URL: `https://seusite.com/wp-json/keyword-updater/v1/update/`
* Body Type: `JSON`
* Body:

```json
{
  "post_id": 123,
  "keywords": "minha palavra chave"
}
```


## 🧪 Teste

Após enviar a requisição, verifique se a palavra-chave foi adicionada corretamente ao post e se os links internos foram atualizados nos demais posts.


## 🛡️ Licença

Este projeto está licenciado sob a **MIT License**. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.


## 👨‍💻 Autor

Desenvolvido por [Hikelmy Henrich](https://hikelmyhenrich.com)
