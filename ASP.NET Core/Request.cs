using System;
using System.Net;
using System.Net.Http;
using System.Threading.Tasks;

namespace Asynchronous.NET.Testing
{
	public static class Downloader
	{
		public static async Task<byte[]> DownloadFileAsync(string uriString, string? authorization = null)
		{
			try
			{
				byte[] bytes = null!;

				var uri = new Uri(uriString);
				var request = new HttpRequestMessage(HttpMethod.Get, uri);

				if (!string.IsNullOrEmpty(authorization))
				{
					request.AddHeaders(HttpRequestHeader.Authorization.ToString(), authorization);
				}

				using (var client = HttpClientFactory.Create())
				{
					client.Timeout = TimeSpan.FromMinutes(10);

					var result = await client.SendAsync(request);

					if (result.IsSuccessStatusCode)
					{
						bytes = await result.Content.ReadAsByteArrayAsync();
					}

					result.Dispose();
				}

				return bytes;
			}
			catch (Exception e)
			{
				throw e;
			}
		}

		private static HttpRequestMessage AddHeaders(this HttpRequestMessage request, string name, string? value)
		{
			request.Headers.Add(name, value);
			return request;
		}
	}
}
